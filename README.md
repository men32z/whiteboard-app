# Whiteboard App

> Whiteboard with real-time collaboration, drawing, image uploading, and management features.


## Notes
### This project has these features:
  - Authentication.
  - Whiteboard CRUD functionality.
  - Granting and removing access to whiteboards.
  
  Even though the main feature is the whiteboard, it makes sense to start with the basic way to create modify, and access the whiteboards also for this example it showcases knowledge of both frontend and backend with Laravel and Vue. Starting with the main component probably will take more time than the few hours available, and it will only showcase javascript knowledge.

### Next features
#### Whiteboard functionality: 

  For the first version, we could implement an existing whiteboard NPM library. This would make the development faster, but it would lack customization in the future. 
  Creating a custom Vue component is the best choice, using libraries like D3, or Konva, consider that this option will delay a possible mvp.

#### Whiteboard Entity model: 
  The data model that we will use has a dependency on the whiteboard component by itself, I would recommend having a JSON format to manage different possible versions of the whiteboard, also I will consider adding a mongo database to store the whiteboard information.

#### Whiteboard Broadcasting: 
  Adding a pusher service isn't difficult, but we must first have the whiteboard. Then we can make the rest endpoints to use on the whiteboard.

#### Extras:
 - Drawing shapes
 - Uploading documents

## Built With

- Laravel [Readme](./LARAVEL.md)

## Local Install

This project was created with Laravel built in tools.

1. Clone the project to your local directory

```
 git clone git@github.com:men32z/whiteboard-app.git
```

2. Get in to the folder app

```
cd whiteboard-app
```
3. Prepare environment, don't forget to modify .env file.

```
composer install
npm install
php artisan migrate --seed
```

4. run server

```
php artisan serve
npm run dev
```

### Usage

Go to Localhost in your favorite browser

```
http://localhost:5173/
```

or to use api access 
```
http://127.0.0.1:8000
```

### Run tests

```
php artisan test
```

## Author

👤 **Luis Preza**

- Github: [@men32z](https://github.com/men32z)
- Linkedin: [Luis Preza](https://www.linkedin.com/in/men32z/)

## 🤝 Contributing

Contributions, issues and feature requests are welcome!

Feel free to check the [issues page](https://github.com/men32z/whiteboard-app/issues).

## Show your support

Give a ⭐️ if you like this project!

### 📝 License

MIT.