<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>E-Learning | <?= ucfirst($_SESSION['user_role']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <style>
    html, body {
      overflow-x: hidden;
      margin: 0;
      padding: 0;
      overflow-x: hidden; /* ✅ Mencegah scroll horizontal */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8fafc;
    }
  </style>
</head>
<body class="min-h-screen overflow-x-auto">
