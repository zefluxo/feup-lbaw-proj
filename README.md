# PA: Product and Presentation

> For music lovers who want a tailored retailer of their favorite artists' releases, EarWorm is a website that provides a trustworthy and all-inclusive selection of music.

## A9: Product

EarWorm website was developed by a small group of FEUP students, with a passion for both music and the preservation of its physical mediums, as a platform targeted at individual users that wish to buy physical musical products.

The main goal of the project is the development of a web-based and individually stylized music store for browsing and buying musical merchandise such as CDs, vinyls or other music affiliated products. After the initial deployment of the site, a team of administrators is required and will be responsible for managing the system and the stock, as well as ensuring any transaction runs smoothly.

This online platform grants users access to a vast library of purchaseable musical content, while also keeping track of their on-site transactions. Products are available for worldwide distribution, providing a myriad of payment options. Curated recommendations will be provided to each user based on their listening preferences.

Users are separated into groups with different permissions. These groups include the site administrators, with complete access and modification privileges, and the registered users, with privileges to enter information, buy and cancel ordered items, browse and inspect the site's products and rate previously obtained items.

The platform will have a responsive design, allowing users to have a pleasant browsing experience not only visually but functionally as well, regardless of the device (desktop, tablet or smartphone).

### 1. Installation

In order to install and run follow these steps:

> Start by cloning the repository & entering the directory

> Open a terminal window and link laravel's storage and serve a server
> ```php artisan storage:link```
> ```php artisan serve```

> On a separate window start the composer container for the database
> ```docker compose up```

> Be sure to check which ```.env```file you are using during this process (prod or dev)

### 2. Usage

If you are locally deployed and running your own server, you may visit ```http://127.0.0.1:8000``` to start using the application.

#### 2.1. Administration Credentials

Administration URL: ```http://lbaw22123.lbaw.fe.up.pt/admin```  

| Username             | Password |
| -------------------- | -------- |
| admin@example.com    | password |

#### 2.2. User Credentials

| Type          | Username           | Password     |
| ------------- | ------------------ | ------------ |
| basic account | user@example.com   | userpassword |

### 3. Implementation Details
#### 3.1. Libraries Used

> Flickity: https://flickity.metafizzy.co/

Used for smooth and responsive carousels. Implemented in multiple pages throughout the website, one such page is the homepage of the application, in the index.js file.

> BB-Code-To-HTML: https://coursesweb.net/javascript/convert-bbcode-html-javascript_cs

Whilst not a library, we felt that is important to mention that the code that makes us able to have BBCode on the artist pages and translate it into valid HTML code was not developed by us as it is a moderately complex piece of JavaScript code.

***
GROUP 22123, 03/01/2023

* Pedro Alexandre Ferreira e Silva - up202004985@edu.fe.up.pt
* António Oliveira Santos - up202008004@edu.fe.up.pt
* José Luís Nunes Osório - up202004653@edu.fe.up.pt 
* José Maria Borges Pires do Couto e Castro - up202006963@edu.fe.up.pt* ...
