##УСТАНОВКА

git clone https://github.com/KOVCHENKO/testnewsauthors.gt   
sudo chmod -R 777 testnewauthors    
cd testnewauthors    

docker-compose up  -d    
docker exec -it appbolgofteam php artisan migrate    
# Открыть браузер по адресу 0.0.0.0:8181     
