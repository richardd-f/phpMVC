<?php
require_once("../../model/Music.php");
require_once("../../model/Singer.php");

$music = new Music();
$singer = new Singer();

$singer_list = $singer->getAllSingers() ?? [];
$assignments = $music->getAllAssignedMusics()["data"] ?? [];

// if in edit mode, fetch the current assignment details
$music_list = $music -> getAllMusic()["data"] ?? [];
$editMusicId = $_GET['edit_music'] ?? null;
$editSingerId = $_GET['edit_singer'] ?? null;

$isEditing = $editMusicId && $editSingerId;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Music & Singer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <?php require_once("../nav.php")?>

    <div class="max-w-5xl mx-auto p-4 sm:p-6 md:p-8">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Music Assigned to Singer</h1>

        <!-- Assignments Table -->
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full text-left bg-white">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="p-4 font-semibold text-sm uppercase">Music Title</th>
                        <th class="p-4 font-semibold text-sm uppercase">Singer Name</th>
                        <th class="p-4 font-semibold text-sm uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($assignments)): ?>
                        <?php foreach ($assignments as $assignment): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 text-gray-700"><?php echo htmlspecialchars($assignment['music_title']); ?></td>
                                <td class="p-4 text-gray-700"><?php echo htmlspecialchars($assignment['singer_name']); ?></td>
                                <td class="p-4 text-center flex justify-center space-x-2">
                                    <!-- Edit Button -->
                                    <a href="/view/page/assignMusicSinger.php?edit_music=<?php echo $assignment['music_id']; ?>&edit_singer=<?php echo $assignment['singer_id']; ?>" 
                                        class="bg-blue-500 p-2 rounded-md hover:bg-blue-600 flex items-center justify-center text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.75 20.902l-4.5 1.125 1.125-4.5L16.862 4.487z" />
                                        </svg>
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="/controller/MusicSinger.php?action=unassign" method="POST" style="display:inline;">
                                        <input type="hidden" name="music" value="<?php echo $assignment['music_id']; ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to unassign the singer?')"
                                            class="bg-red-500 p-2 rounded-md hover:bg-red-600 flex items-center justify-center text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-500">
                                No assignments found
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <hr class="my-8 border-gray-300">

        <!-- Assigner Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Assign Singer to Music</h2>
            <form action="/controller/MusicSinger.php?action=add" method="POST" class="space-y-4">
                
                <div>
                    <label for="music" class="block text-sm font-medium text-gray-700">Select Music</label>
                    <select id="music" name="music" class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md border">
                        <option>-- Choose a song --</option>
                        <?php foreach ($music_list as $music): ?>
                            <option value="<?php echo htmlspecialchars($music['music_id']); ?>" <?= $music['music_id'] == $editMusicId? " selected": ""?>>
                                <?php echo htmlspecialchars($music['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="singer" class="block text-sm font-medium text-gray-700">Select Singer</label>
                    <select id="singer" name="singer" class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md border">
                        <option>-- Choose a singer --</option>
                        <?php foreach ($singer_list as $singer): ?>
                            <option value="<?php echo htmlspecialchars($singer['singer_id']); ?>" <?= $singer['singer_id'] == $editSingerId? " selected": ""?>>
                                <?php echo htmlspecialchars($singer['name']); ?>
                                
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded-md hover:bg-green-600 transition duration-200">
                    Assign
                </button>
            </form>
        </div>

    </div>

</body>
</html>
