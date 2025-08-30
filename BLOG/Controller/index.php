<?php

require __DIR__ . '/../Database.php';
require __DIR__ . '/../Blog.php';

$db = (new Database())->connect();
$blog = new Blog($db); 

$posts = $blog->getAllPost();

?>

<div class="container">
<h2>Blog Posts</h2>
<a href="create.php"> Create New Post</a><br><br>

<?php foreach($posts as $post): ?>
    <div class="post">
        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        <?php if ($post['image']): ?>
            <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" style="max-width= 150;" alt="Post Image" style="max-width:200px;"><br><br>
        <?php endif; ?>
        <small>Posted on: <?php echo $post['created_at'];?></small>
        <div class="actions">
            <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');"> 
                Delete</a>    
        </div>     
    </div>
<?php endforeach; ?>
</div>