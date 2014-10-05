<?php
/**
 * Created by JetBrains PhpStorm.
 * User: manuel.moyano
 * Date: 17/09/13
 * Time: 10:51
 * To change this template use File | Settings | File Templates.
 */

class menu {

    protected $tb_userweb = "users";
    protected $tb_uw_profile = "user_profiles";
    protected $tb_profile = "profiles";
    protected $tb_profile_module = "profile_modules";
    protected $tb_module = "modules";
    protected $tb_description = "descriptions";
    protected $tb_company = "companies";
    protected $tb_country = "countries";
    protected $tb_language = "languages";




    function menu(){
        $this->con = new DataBase();
    }

    function getAccess($email)
    {
        $email = addslashes($email);

        $query = $this->con->genericQuery("select uw._id 'id_User',uw.name 'User' ,uw.email,m._id  'id_Module',
                                      d.description 'Module',m.parent,m.type,m.class,pm.url,pm.start_module,up.first_profile,up.fk_profile 
                                      from " . $this->tb_userweb . " uw
                                      inner join ". $this->tb_uw_profile ." up
                                      on uw._id = up.fk_user
                                      inner join ".$this->tb_profile." p
                                      on up.fk_profile = p._id
                                      inner join ". $this->tb_profile_module ." pm
                                      on p._id = pm.fk_profile
                                      inner join ". $this->tb_module ." m
                                      on pm.fk_module = m._id
                                      inner join ". $this->tb_company ." com
                                      on uw.fk_company = com._id
                                      inner join ". $this->tb_country ." cou
                                      on com.fk_country = cou._id
                                      inner join ". $this->tb_language ." l
                                      on cou.fk_language = l._id
                                      inner join ". $this->tb_description ." d
                                      on m.fk_description = d._id and l._id = d.fk_language
                                      where uw.email ='$email'
                                      and uw.status = 1
                                      and p.status = 1
                                      and m.status = 1
                                      order by m._id");
            
        if (count($query) == 0)
            return false;
        else {
            return $query;
        }
    }
}