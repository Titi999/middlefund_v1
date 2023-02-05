<style>
  .profile-pic{
    background: #A49370;
    color: #eeeeee;
    border-radius: 50%;
    height: 35px;
    width: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
    -webkit-box-shadow: #A49370;
    box-shadow: #A49370;
    object-fit:contain;
  }
  #profileDrop{
       background-color: #A49370;
  }
</style>

<?php
function getProfilePicture($name){
  $name_slice = explode(' ',$name);
    $name_slice = array_filter($name_slice);
    $initials = '';
  $initials .= (isset($name_slice[0][0]))?strtoupper($name_slice[0][0]):'';
  $initials .= (isset($name_slice[count($name_slice)-1][0]))?strtoupper($name_slice[count($name_slice)-1][0]):'';
   return '<div class="profile-pic">'.$initials.'</div>';
}
?>