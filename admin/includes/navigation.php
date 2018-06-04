<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">AQG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="questions.php?action=add">Add Users</a>
                    <a class="dropdown-item" href="questions.php">View All Users</a>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="subjects.php">Subjects</a>
            </li>
            
            
            <li class="nav-item dropdown">
                <a class="nav-link" href="chapters.php">Chapters</a>
            </li>
            
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Questions</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="questions.php?action=add">Add Questions</a>
                    <a class="dropdown-item" href="questions.php">View All Questions</a>
                </div>
            </li>
            
        </ul>
        
        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Logout</button>
        
    </div>
</nav>
