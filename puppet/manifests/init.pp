exec { 'apt_update':
  command => 'apt-get update',
  path    => '/usr/bin'
}

# Install git on vagrant
class { 'git::install': }
# Install apache on vagrant
class { 'apache2::install': }
# Install php5 on vagrant
class { 'php5::install': }
# Install mysql on vagrant
class { 'mysql::install': }
# install wordpress on vagrant
class { 'wordpress::install': }
