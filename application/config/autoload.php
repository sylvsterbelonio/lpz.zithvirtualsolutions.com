<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('form_validation','session','pagination','database','email','user_agent','image_lib',
                            'Loading','Field','Modal','Toolbar','Popup','Breadcrumb','Dashboard','Profile','Member',
                            'Network','Mission','Chart','Tables','Ajax','DateParser');

$autoload['drivers'] = array();

$autoload['helper'] = array('url','form','date');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('AuthModel','MenuModel','ProfileModel','ChurchModel','UsersManagementModel','SystemAccessModel','NotificationModel',
                            'TaskModel','RewardModel','AchievementModel','AppModel','HomeModel', 'ChurchFormModel','SpatialModel',
                            'RolesModel','RolesFormModel','MembersFormModel','MembersModel','ParameterModel',
                            'NetworkModel','MissionModel','SecurityModel','BookModel','BibleModel','MusicModel','EbookModel','SlidesModel');
