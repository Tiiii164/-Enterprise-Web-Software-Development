<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <router-link class="navbar-brand" :to="{name: 'Staff Home'}">Idea</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" :to="{name: 'Staff Home'}">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link active" aria-current="page" :to="{name: 'Staff Submission'}">Staff Submission</router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Log In</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Log Out</a>        
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>

