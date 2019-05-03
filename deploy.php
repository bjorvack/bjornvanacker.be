<?php
namespace Deployer;

require 'recipe/common.php';


set('release_name', function () {
    return date('YmdHis');
});

// Project name
set('application', 'bjornvanacker.be');

// Project repository
set('repository', 'https://github.com/bjorvack/bjornvanacker.be.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

set('keep_releases', 3);

// Shared files/dirs between deploys 
set('shared_files', [
    '.env.local'
]);
set('shared_dirs', [
    '/var/log'
]);

// Writable dirs by web server 
set('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
inventory('hosts.yaml');

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
