1. clone repository
2. update MACHINE_IP in .env
3. add hosts
    - api.local MACHINE_IP
    - panel.local MACHINE_IP
4. docker-compose build
5. docker-compose up -d
6. docker exec -i -t php api/bin/console d:s:u -f
7. swagger:
    - api.local/api
    - Basic Auth:
        - api
        - api12
8. panel:
    - panel.local/admin
    - Auth:
        - admin
        - admin12