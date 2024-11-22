Instruction to start with the application  

1- The application Kiwi_V3 is on GitLab   

2- Get repository  
==> cd Kiwi_V3  
==> composer install  

3- Modify the .env to .env.local to access to the databases  
DATABASE_URL="mysql://root:@127.0.0.1:3306/kiwi_v3?serverVersion=8.0.32&charset=utf8mb4"  


4- Create a databases  
==> php bin/console doctrine:database:create  

5- Useful commands :  
Create entity (except user):  
==> php bin/console make:entity class_name  
Create controller :   
==> php bin/console make:controller entity_name  
Create controller + template :  
==> php bin/console make:crud entity_name  
Create form:  
==> php bin/console make:form  

6- Migration to databases  
Generate new migration (create a version in your project):  
==> php bin/console make:migration  
push the version to the databases  
==> php bin/console doctrine:migrations:migrate  

7- composers that need to be installed   
Chart.js :  
 ==> composer require symfony/ux-chartjs  
