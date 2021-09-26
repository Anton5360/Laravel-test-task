Hi there! There are some instructions to launch this _test task_

1. Since I use docker in this project you should copy **.env-example** file in the root directory and change values as you want. Then you should do the same in the .env file in laravel directory
2. Run 'php artisan migrate' inside your php docker container (docker exec -it **container_name** bash)
3. Run 'php artisan migrate db:seed'
**P.S**. By the way, in DatabaseSeeder you have possibility to change quantity of generating departments and employees (There are generating 10 departments and 100 employees by default).
4. After all, just test it :D

**_XML file example:_**

`<?xml version="1.0" encoding="UTF-8"?>
<employees>
    <employee>
        <department_id>135</department_id>
        <first_name>Testing</first_name>
        <Last_name>Testing</Last_name>    
        <middle_name>Testing</middle_name>    
        <birthdate>1997-06-10</birthdate>    
        <position>HR</position>    
        <salary_type>hourly</salary_type>    
        <work_hours>10.2</work_hours>    
        <salary>230</salary>        
    </employee>
    <employee>
        <department_id>133</department_id>
        <first_name>Testing2</first_name>
        <Last_name>Testing2</Last_name>
        <middle_name>Testing2</middle_name>
        <birthdate>2000-01-25</birthdate>
        <position>developer</position>
        <salary_type>monthly</salary_type>
        <work_hours>32.1</work_hours>
        <salary>1200</salary>
    </employee>
</employees>
`
