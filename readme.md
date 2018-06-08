##УСТАНОВКА

git clone https://github.com/KOVCHENKO/testnewsauthors.git   
sudo chmod -R 777 testnewsauthors    
cd testnewsauthors    

docker-compose up  -d    
docker exec -it appbolgofteam php artisan migrate    
docker exec -it appbolgofteam php artisan db:seed    

Открыть браузер по адресу 0.0.0.0:8181     
