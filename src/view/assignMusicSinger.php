<?php
// Dummy database for Music
$music_list = [
    ['title' => 'Bohemian Rhapsody'],
    ['title' => 'Smells Like Teen Spirit'],
    ['title' => 'Hotel California'],
    ['title' => 'Stairway to Heaven'],
    ['title' => 'Like a Rolling Stone'],
];

// Dummy database for Singers
$singer_list = [
    ['name' => 'Freddie Mercury'],
    ['name' => 'Kurt Cobain'],
    ['name' => 'Don Henley'],
    ['name' => 'Robert Plant'],
    ['name' => 'Bob Dylan'],
];

// Dummy database for existing assignments
$assignments = [
    [
        'music_title' => 'Bohemian Rhapsody',
        'singer_name' => 'Freddie Mercury'
    ],
    [
        'music_title' => 'Smells Like Teen Spirit',
        'singer_name' => 'Kurt Cobain'
    ],
    [
        'music_title' => 'Hotel California',
        'singer_name' => 'Don Henley'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Music & Singer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-4 sm:p-6 md:p-8">

    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">🤝 Assign Music to Singer</h1>

        <!-- Assignments Table -->
        <div class="shadow-md rounded-lg overflow-hidden">
            <table class="w-full text-left bg-white">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="p-4 font-semibold text-sm uppercase">Music Title</th>
                        <th class="p-4 font-semibold text-sm uppercase">Singer Name</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($assignments as $assignment): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($assignment['music_title']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($assignment['singer_name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr class="my-8 border-gray-300">

        <!-- Assigner Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Create New Assignment</h2>
            <form action="" method="POST" class="space-y-4">
                <div>
                    <label for="music" class="block text-sm font-medium text-gray-700">Select Music</label>
                    <select id="music" name="music" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md border">
                        <option>-- Choose a song --</option>
                        <?php foreach ($music_list as $music): ?>
                            <option value="<?php echo htmlspecialchars($music['title']); ?>">
                                <?php echo htmlspecialchars($music['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="singer" class="block text-sm font-medium text-gray-700">Select Singer</label>
                    <select id="singer" name="singer" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md border">
                        <option>-- Choose a singer --</option>
                        <?php foreach ($singer_list as $singer): ?>
                            <option value="<?php echo htmlspecialchars($singer['name']); ?>">
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
