# Befeni Technical Test [Basic] by Swam Htet Aung

## How to run the project

### Clone the project

```
git clone https://github.com/swamhtetaung8/basic-test-benefi.git
```

### cd into the project

```
cd basic-test-benefi
```

### Easy run with docker-compose up

```
docker-compose up
```

This should install all dependencies and run both backend and frontend.

### If docker-compose up didn't work

```
cd backend
composer install
php serve.php
```

This should start the backend server. If your enviroment doesn't have composer installed, install composer first from their website.

```
cd frontend
npm install
npm run dev
```

This will start the frontend server.

## Unit Tests

### Backend -> backend/tests/unit

### Running the test

```
cd backend
./vendor/bin/phpunit
```

Will be 1 error after first run because one of the tests is about creating a folder and if it is already exists, it will return false and it's completely fine.

### Frontend -> src/components/CalculatorForm.test.tsx

### Running the test

```
cd frontend
npm run test
```

## External Libraries used

- PSR4 for autoloading classes
- PHPUnit for unit tests in backend
- axios for data fetching
- tailwindcss for styling
- jest, jsdom, vitest for unit tests in frontend
