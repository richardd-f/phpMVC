<?php
// A simple array to act as our dummy database
$music_list = [
    [
        'title' => 'Bohemian Rhapsody',
        'duration' => '5:55',
        'published' => '1975-10-31',
        'singer' => 'Queen'
    ],
    [
        'title' => 'Smells Like Teen Spirit',
        'duration' => '5:01',
        'published' => '1991-09-10',
        'singer' => 'Nirvana'
    ],
    [
        'title' => 'Hotel California',
        'duration' => '6:30',
        'published' => '1977-02-22',
        'singer' => 'Eagles'
    ],
    [
        'title' => 'Stairway to Heaven',
        'duration' => '8:02',
        'published' => '1971-11-08',
        'singer' => 'Led Zeppelin'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Music</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-4 sm:p-6 md:p-8">

    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">🎵 List Music</h1>

        <div class="shadow-md rounded-lg overflow-hidden">
            <table class="w-full text-left bg-white">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="p-4 font-semibold text-sm uppercase">Title</th>
                        <th class="p-4 font-semibold text-sm uppercase">Duration</th>
                        <th class="p-4 font-semibold text-sm uppercase">Published</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($music_list as $music): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($music['title']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($music['duration']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($music['published']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr class="my-8">

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add New Music (Display Only)</h2>
            <form action="" method="POST" class="space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration (e.g., 3:45)</label>
                    <input type="text" id="duration" name="duration" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="published" class="block text-sm font-medium text-gray-700">Published Date</label>
                    <input type="date" id="published" name="published" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200">
                    Add Music
                </button>
            </form>
        </div>

    </div>

</body>
</html>