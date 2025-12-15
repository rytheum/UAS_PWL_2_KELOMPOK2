<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      font-family: 'Montserrat', sans-serif;
    }

    body {
      margin: 0;
      background: #6274e1;
    }

    .layout {
      display: flex;
      min-height: 100vh;
    }

    /* SIDEBAR */
    .sidebar {
      width: 240px;
      background: #fff;
      border-radius: 30px;
      margin: 20px;
      padding: 20px;
    }

    .sidebar h3 {
      text-align: center;
      margin-bottom: 30px;
    }

    .menu a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px;
      margin-bottom: 10px;
      border-radius: 10px;
      color: #333;
      text-decoration: none;
    }

    .menu a.active,
    .menu a:hover {
      background: #eef1ff;
      color: #4a5bdc;
    }

    /* CONTENT */
    .content {
      flex: 1;
      padding: 30px;
      color: #fff;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .cards {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
    }

    .card {
      background: #fff;
      color: #333;
      padding: 20px;
      border-radius: 20px;
    }

    .card small {
      color: #777;
    }

    .card a {
      display: block;
      margin-top: 10px;
      font-size: 13px;
      color: #4a5bdc;
      text-decoration: none;
    }

    .bottom {
      margin-top: 30px;
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 20px;
    }

    .box {
      background: #fff;
      border-radius: 25px;
      padding: 20px;
    }

    img {
      width: 100%;
      border-radius: 20px;
    }

    @media (max-width: 992px) {
      .cards {
        grid-template-columns: repeat(2, 1fr);
      }

      .bottom {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>

  <div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
      <h3>Admin Dashboard</h3>
      <div class="menu">
        <a href="#" class="active"><i class="fa fa-home"></i> Dashboard</a>
        <a href="#"><i class="fa fa-box"></i> Products</a>
        <a href="#"><i class="fa fa-tags"></i> Categories</a>
        <a href="#"><i class="fa fa-receipt"></i> Transactions</a>
        <a href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="content">
      <div class="topbar">
        <h1>DASHBOARD</h1>
        <i class="fa fa-user-circle fa-2x"></i>
      </div>

      <!-- CARDS -->
      <section class="cards">
        <div class="card">
          <small>Categories</small>
          <h2>3 Cat</h2>
          <a href="#">Kelola Categories</a>
        </div>
        <div class="card">
          <small>Product</small>
          <h2>4 Item</h2>
          <a href="#">Kelola Product</a>
        </div>
        <div class="card">
          <small>Transaction</small>
          <h2>5 Trx</h2>
          <a href="#">Kelola Transaction</a>
        </div>
        <div class="card">
          <small>Admin</small>
          <h2>5 People</h2>
          <a href="#">Kelola Admin</a>
        </div>
      </section>

      <!-- BOTTOM CONTENT -->
      <section class="bottom">
        <div class="box">
          <img src="/images/products.png" alt="Products">
        </div>
        <div class="box">
          <img src="/images/finance.png" alt="Finance">
        </div>
      </section>

    </main>
  </div>

</body>

</html>