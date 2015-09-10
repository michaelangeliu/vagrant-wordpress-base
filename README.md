# Wordpress Base #


## What is this repository for? ##
* Quick summary
    * Generic wordpress initialization vagrant
    * Allows for local wordpress sites to be created and quickly
* Version
    * 0.0.0


## How do I get set up? ##

### Test Setup ###
1. `git clone git@bitbucket.org:group360/base-wordpress.git PROJECT_NAME`
2. `git remote set-url origin NEW_GIT_PROJECT_URL`
3. `vagrant up` to start the server
    * This should create a local database
4. Navigate to 'http://localhost:8080/' to check that wordpress is vagrant is successfully provisioned
    * You should be taken to the Wordpress Installation page
    * There is no need to go through this process because we're setting up a database on AWS
5. `vagrant halt`
6. `vagrant destroy` to delete this test setup
7. `git add -A`
8. `git commit -m 'Wordpress initial setup'`
9. `git push`

### AWS ElasticBeanstalk Setup ###
1. Create a new AWS Elastic Beanstalk Application
    1. Select PHP as your platform
    2. Be sure to create an RDS Service in the AWS Console
    3. Go to the RDS Service in the AWS Console
    4. Record the database name, endpoint, username, and password of the new DB
    5. Back in the AWS Elastic Beanstalk environment, set the following environment properties
        * AWS_ACCESS_KEY
        * AWS_SECRET_KEY
        * RDS_DB_NAME
        * RDS_HOSTNAME
        * RDS_PASSWORD
        * RDS_USERNAME
2. Create 'web/local-config.php' and define the following with the information
    * `<?php
          define('WP_HOME','http://localhost:8080');
          define('WP_SITEURL','http://localhost:8080');

          define('DB_NAME', 'DB_NAME');

          /** MySQL database username */
          define('DB_USER', 'DB_USER');

          /** MySQL database password */
          define('DB_PASSWORD', 'DB_PASSWORD');

          /** MySQL hostname */
          define('DB_HOST', 'ENDPOINT_FROM_AWS_RDS');

          /** The aws credentials */
          define('AWS_ACCESS_KEY_ID',     'AWS_ACCESS_KEY_ID');
          define('AWS_SECRET_ACCESS_KEY', 'AWS_SECRET_ACCESS_KEY');
      ?>`
3. `vagrant up` to finish the Wordpress installation
4. Add content to the two files in `.elasticbeanstalk`. See [Step 6](https://www.otreva.com/blog/deploying-wordpress-amazon-web-services-aws-ec2-rds-via-elasticbeanstalk/) for the content of the two files
5. Replace this README.md with relevant information to the new project (See 'Configure, Run, Deploy' below)
6. `git add -A`
7. `git commit -m 'Wordpress Setup with Elasticbeanstalk'`
8. `git push`

## Configure, Run, Deploy
### Run Instructions
1. `vagrant up` in the directory with the Vagrantfile to start/build server
    * It may pop up a terminal window running Virtualbox asking for a login, which you can ignore.
2. Go to `localhost:8080` to see the site.
    * If it doesn't work, vagrant might not have been completely provisioned. Run `vagrant provision` to complete the install.
3. `vagrant halt` to pause server
4. `vagrant destroy` to destroy the server completely on your local host


### Deployment Instructions
* Staging:
    * If you're already set up with your local version and AWS credentials, just run:
        * `eb push`
* Production:
    * Log into AWS and deploy the staging version to production.


### Database configuration
    * DB engine: mysql
    * Engine Version: 5.6
    * Allocated storage: 5GB
    * To make a copy of a database:
        1. `vagrant ssh` to access the local server with mysql
        2. Decide to copy the local database or the staging database
            * Local:
                * `mysqldump --user wordpress --password wordpress --add-locks --disable-keys --extended-insert > /vagrant/puppet/modules/wordpress/files/__FILENAME__.sql`
            * Staging:
                * `mysqldump -h aaggj19uact7a0.cg5moi3czoya.us-east-1.rds.amazonaws.com -u DB_USER -pDB_PASSWORD --port=3306 --single-transaction --routines --triggers --add-locks --disable-keys --extended-insert ebdb> /vagrant/__FILENAME__.sql`
                * Replace the URL with "localhost:8080"
        3. Replace the contents of `wordpress-db.sql`
        4. `vagrant destroy` to remove the current server
        5. `vagrant up` to create a fresh build
    * If using a prexisting database
        1. Replace `/puppet/modules/wordpress/files/wordpress-db.sql`
        2. Uncomment lines 22-30 in `/puppet/modules/wordpress/manifests/init.pp`
        3. `vagrant destroy`
        4. `vagrant up`

## Configuration ##
### Dependencies ###
* Vagrant (will build you a server with the necessary provisions)
* VirtualBox


## Contributors
* Michael Liu
