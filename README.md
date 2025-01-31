# Gold Trade API

This project is a **Dockerized Laravel-based API** for buying and selling gold between users. It supports automated order matching, transaction fees, and user balance management.

## Features
- **Modular Laravel structure**
- **Automated order matching** for buy/sell trades
- **Tiered transaction fees** based on trade weight
- **User balance management** for gold and fiat currency
- **RESTFULL API with Laravel & MySQL**
- **Dockerized deployment**

## Setup Instructions

### 1. Clone the Repository
```sh
git clone https://github.com/baghieereza/tlyn-assignment
cd tlyn-assignment
```

### 2. Build and Start Docker Containers
```sh
docker-compose up --build -d
```

### 3. Access Laravel App Container
```sh
docker exec -it tlyn-app bash
```

### 4. Run Composer Dump-Autoload
```sh
composer dump-autoload
```

### 5. Run Migrations & Seeders
```sh
php artisan migrate --seed
```

## API Endpoints
| Method | Endpoint         | Description            |
|--------|-----------------|------------------------|
| `POST` | `/orders`       | Place a buy/sell order |
| `GET`  | `/orders`       | List all orders        |
| `GET`  | `/transactions` | View trade history     |

## Transaction Fee Structure
| Gold Weight        | Fee (%)  |
|--------------------|---------|
| Up to 1 gram      | 2%      |
| 1 to 10 grams     | 1.5%    |
| Above 10 grams    | 1%      |
| **Min Fee**       | 50,000 Tomans |
| **Max Fee**       | 5,000,000 Tomans |

## Stopping the Containers
To stop and remove the containers:
```sh
docker-compose down
```

🚀 Your Laravel API is now set up and ready to handle gold trading transactions!

