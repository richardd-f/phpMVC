<?php
    require_once __DIR__ . "/../../model/Music.php";
    
    $musicModel = new Music();
    $music_list = $musicModel->getAllMusic();

    // Function to convert seconds to "mm:ss" format
    function formatDuration($seconds) {
        $minutes = floor($seconds / 60);
        $secs = $seconds % 60;
        return sprintf("%d:%02d", $minutes, $secs);
    }


    $isEdit = isset($_GET["edit"]);
    $actionUrl = $isEdit 
    ? "../../controller/Music.php?action=edit&id=" . $_GET["singer_id"]
    : "../../controller/Music.php?action=add";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>List Music</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 font-sans">
        <?php require_once("../nav.php")?>

    <div class="max-w-5xl mx-auto p-4 sm:p-6 md:p-8">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">List Music</h1>

        <div class="shadow-md rounded-lg overflow-hidden overflow-x-auto">
            <table class="min-w-full text-left bg-white">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="p-4 font-semibold text-sm uppercase">Title</th>
                        <th class="p-4 font-semibold text-sm uppercase">Duration</th>
                        <th class="p-4 font-semibold text-sm uppercase">Published on</th>
                        <th class="p-4 font-semibold text-sm uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if ($music_list["success"] && !empty($music_list["data"])): ?>
                        <?php foreach ($music_list["data"] as $index => $music): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 text-gray-700"><?php echo htmlspecialchars($music['title'] ?? ''); ?></td>
                                <td class="p-4 text-gray-700">
                                    <?php echo formatDuration($music['duration']); ?>
                                </td>
                                <td class="p-4 text-gray-700"><?php echo htmlspecialchars($music['publishDate'] ?? ''); ?></td>
                                <td class="p-4">
                                    <div class="flex justify-center items-center gap-2">
                                        <!-- Edit Button -->
                                        <a href="/controller/Music.php?action=edit&musicId=<?php echo $music['music_id']; ?>" 
                                        class="inline-flex items-center justify-center bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.75 20.902l-4.5 1.125 1.125-4.5L16.862 4.487z" />
                                            </svg>
                                        </a>
                                        <!-- Delete Button -->
                                        <a href="../../controller/Music.php?action=delete&musicId=<?php echo $music['music_id']; ?>" 
                                        onclick="return confirm('Are you sure you want to delete this music?');"
                                        class="inline-flex items-center justify-center bg-red-500 text-white p-2 rounded-md hover:bg-red-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">
                            <?php echo htmlspecialchars($music_list["err"] ?? "No music found"); ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        </div>
        <hr class="my-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        <?php echo $editMode ? "Edit Music" : "Add New Music"; ?>
    </h2>

    <form action="../../controller/Music.php" method="POST" class="space-y-4">
        <?php if ($editMode): ?>
            <input type="hidden" name="music_id" value="<?php echo htmlspecialchars($musicToEdit['music_id']); ?>">
        <?php endif; ?>

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input required type="text" id="title" name="title"
                value="<?php echo $editMode ? htmlspecialchars($musicToEdit['title'] ?? '') : ''; ?>"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="duration" class="block text-sm font-medium text-gray-700">Duration (mm:ss)</label>
            <input required type="text" id="duration" name="duration"
                value="<?php echo $editMode ? htmlspecialchars(formatDuration($musicToEdit['duration'])) : ''; ?>"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="publishDate" class="block text-sm font-medium text-gray-700">Published Date</label>
            <input required type="date" id="publishDate" name="publishDate"
                value="<?php echo $editMode ? htmlspecialchars($musicToEdit['publishDate'] ?? '') : ''; ?>"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                    focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
            <button name="<?php echo $editMode ? 'editmusic_button' : 'addmusic_button'; ?>" 
                type="submit"
                class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
                <?php echo $editMode ? 'Update Music' : 'Add Music'; ?>
            </button>
        </form>
    </div>

    </div>
    
</body>
</html>
