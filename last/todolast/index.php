<?php 
require 'db_conn.php';
session_start();
$x=$_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <style>
        .heading{
            position: absolute;
            width: 465px;
            height: 28px;
            left: 950px;
            top: 6px;

            font-family: Montserrat;
            font-style: normal;
            font-weight: 800;
            font-size: 32px;
            line-height: 28px;
            /* identical to box height, or 88% */


            /* Brand Colors/CB Green */

            color: #0B4B36;

}
    </style>

</head>
<body>
    <a href="../logout.php" style="position: absolute;
                                    font-family: Montserrat;
                                    width: 465px;
                                    height: 28px;
                                    left: 950px;
                                    top: 6px;
                                    color: #0B4B36;">Signout</a>
   
    <h3 class="heading">Welcome &nbsp;<b><?php echo $x ?></b></h3>

    <p></p>
    <div >
       <div >
          <form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" 
                     name="title" 
                     style="border-color: #ff6666; "
                     placeholder="This field is required" />

                     <input type="text" 
                     name="label" 
                     style="border-color: #ff6666"
                     placeholder="This field is required" />

                     <input type="text" 
                     name="priority" 
                     style="border-color: #ff6666"
                     placeholder="This field is required" />

              <button type="submit">Add &nbsp; <span>&#43;</span></button>

             <?php }else{ ?>
              <input type="text" 
                     name="title" 
                     placeholder="What do you need to do?" />

               <input type="text" 
                     name="label" 
                     placeholder="label" />

             <input type="text" 
             name="priority" 
             placeholder="priority" />
              <button type="submit">Add &nbsp; <span>&#43;</span></button>

             <?php } ?>
          </form>
       </div>
       <?php 
          $todos = $conn->query("SELECT * FROM todos WHERE user_name='$x' ORDER BY id DESC");
       ?>
       <div>
            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div>
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    
                        <h2><?php echo $todo['title'] ?></h2>
        
                    <br>
                    <small>Priority: <?php echo $todo['priority'] ?></small>
                    <br>
                    <small>Label: <?php echo $todo['label'] ?></small> 
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

        });
    </script>
</body>
</html>