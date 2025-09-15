<?php 
$msgIsError = null;
$msg = "";

if(isset($_GET["err"])){
  $msgIsError = true;
  $msg = urldecode($_GET["err"]);
} else if(isset($_GET["msg"])){
  $msgIsError = false;
  $msg = urldecode($_GET["msg"]); 
}
?>

<!-- Navbar -->
<nav class="bg-blue-600 shadow-lg">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between h-16 items-center">
      
      <!-- Logo / Title (hidden on small screens) -->
      <div class="text-white font-bold text-lg tracking-wide hidden md:block">
        Sing-Song
      </div>

      <!-- Navigation Buttons -->
      <div class="flex space-x-2 sm:space-x-4">
        <a href="/view/page/addMusic.php" 
           class="px-3 sm:px-4 py-2 rounded-lg text-white text-md sm:text-base font-medium hover:bg-blue-500 hover:shadow-md transition">
          Music
        </a>
        <a href="/view/page/addSinger.php" 
           class="px-3 sm:px-4 py-2 rounded-lg text-white text-md sm:text-base font-medium hover:bg-blue-500 hover:shadow-md transition">
          Singer
        </a>
        <a href="/view/page/assignMusicSinger.php" 
           class="px-3 sm:px-4 py-2 rounded-lg text-white text-md sm:text-base font-medium hover:bg-blue-500 hover:shadow-md transition">
          Assignment
        </a>
      </div>
    </div>
  </div>
</nav>

<?php if ($msgIsError !== null): ?>
  <div id="notification" class="max-w-7xl mx-auto mt-4 px-4">
    <div  class="relative p-4 rounded-lg shadow-md flex items-start justify-between 
                <?= $msgIsError ? 'bg-red-100 text-red-700 border border-red-300' : 'bg-green-100 text-green-700 border border-green-300'; ?>"
    >
      
      <!-- Message -->
      <span><?php echo htmlspecialchars($msg); ?></span>
      
      <!-- Close Button -->
      <button onclick="document.getElementById('notification').style.display='none'" 
              class="ml-4 text-xl font-bold leading-none text-gray-500 hover:text-gray-700">
        &times;
      </button>
    </div>
  </div>
<?php endif; ?>