<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/rsync.php';

// Config

set('application', 'Homebuka Server');
set('ssh_multiplexing', true); // Speeds up deployments

set('rsync_src', function () {
    return __DIR__;
});

set('repository', 'git@github.com:Homebuka-Limited/homebuka-server.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Configuring the rsync exclusions.
// You'll want to exclude anything that you don't want on the production server.
add('rsync', [
    'exclude' => [
        '.git',
        '.env',
        '/node_modules/',
        '.github',
        'deploy.php',
    ],
]);

// Set up a deployer task to copy secrets to the server.
// Since our secrets are stored in Github Secrets, we can access them as env vars.
task('deploy:secrets', function () {
    file_put_contents(__DIR__ . '/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path') . '/shared');
});


// Hosts

host('server','staging')
    ->setHostname('ec2-18-206-121-142.compute-1.amazonaws.com')
    //->set('identity_file','~/Desktop/Topazdom/Clients/HomeBuka/SSH/HomeBuka Key.pem') //comment before push.
    ->set('remote_user', 'ubuntu')
    ->setDeployPath('/var/www/{{alias}}.homebuka.com')
    ->set('branch','production');
/* host('staging')
    ->setHostname('18.206.121.142')
    ->set('remote_user', 'root')
    ->setDeployPath('/var/www/{{alias}}.homebuka.com')
    ->set('branch','staging'); */

// Hooks

desc('Deploy the Server Application');

task('deploy', [
    'deploy:prepare',
    'rsync', // Deploy code & built assets
    'deploy:secrets', // Deploy secrets
    'artisan:storage:link', // |
    'artisan:view:cache',   // |
    'artisan:config:cache', // | Laravel Specific steps
    'artisan:route:cache',     // |
    'artisan:migrate',      // |
    'artisan:queue:restart',// |
    'deploy:publish',
]);
after('deploy:failed', 'deploy:unlock'); // Unlock after failed deploy

//Include Changelog in Deployment Push