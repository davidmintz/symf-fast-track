<?php

use EasyCorp\Bundle\EasyDeployBundle\Deployer\DefaultDeployer;

return new class extends DefaultDeployer
{
    public function configure()
    {
        return $this->getConfigBuilder()
            ->useSshAgentForwarding(true)
            // SSH connection string to connect to the remote server (format: user@host-or-IP:port-number)
            ->server('dogen')
            // the absolute path of the remote server directory where the project is deployed
            ->deployDir('/opt/www/symf-fast-track')
            // the URL of the Git repository where the project code is hosted
            ->repositoryUrl('git@github.com:davidmintz/symf-fast-track.git')
            
            
            // the repository branch to deploy
            ->repositoryBranch('master')
        ;
    }

    // run some local or remote commands before the deployment is started
    public function beforeStartingDeploy()
    {
        // $this->runLocal('./vendor/bin/simple-phpunit');
    }

    // run some local or remote commands after the deployment is finished
    public function beforeFinishingDeploy()
    {
        // $this->runRemote('{{ console_bin }} app:my-task-name');
        // $this->runLocal('say "The deployment has finished."');
    }

    public function beforePreparing()
    { 
        // gratitude: lcavero comment on https://github.com/EasyCorp/easy-deploy-bundle/issues/99
        $this->runRemote('cp {{ deploy_dir }}/repo/.env {{ project_dir }}/.env'); 
        // $this->runRemote('cp {{ deploy_dir }}/repo/.env.development {{ project_dir }}/.env.development'); 
    }
};
