<?php
// A simple array to act as our dummy database for singers
$singer_list = [
    [
        'name' => 'Freddie Mercury',
        'birthdate' => '1946-09-05',
        'genre' => 'Rock',
        'height' => '177 cm',
        'weight' => '74 kg'
    ],
    [
        'name' => 'Kurt Cobain',
        'birthdate' => '1967-02-20',
        'genre' => 'Grunge, Alternative Rock',
        'height' => '175 cm',
        'weight' => '69 kg'
    ],
    [
        'name' => 'Axl Rose',
        'birthdate' => '1962-02-06',
        'genre' => 'Hard Rock',
        'height' => '175 cm',
        'weight' => '77 kg'
    ],
    [
        'name' => 'Elvis Presley',
        'birthdate' => '1935-01-08',
        'genre' => 'Rock and Roll, Pop',
        'height' => '182 cm',
        'weight' => '77 kg'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Singer</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-4 sm:p-6 md:p-8">

    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">🎤 List Singer</h1>

        <!-- Singer Table -->
        <div class="shadow-md rounded-lg overflow-hidden">
            <table class="w-full text-left bg-white">
                <thead class="bg-purple-500 text-white">
                    <tr>
                        <th class="p-4 font-semibold text-sm uppercase">Name</th>
                        <th class="p-4 font-semibold text-sm uppercase">Birthdate</th>
                        <th class="p-4 font-semibold text-sm uppercase">Genre</th>
                        <th class="p-4 font-semibold text-sm uppercase">Height</th>
                        <th class="p-4 font-semibold text-sm uppercase">Weight</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($singer_list as $singer): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['name']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['birthdate']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['genre']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['height']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['weight']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr class="my-8 border-gray-300">

        <!-- Add Singer Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add New Singer (Display Only)</h2>
            <form action="" method="POST" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label for="birthdate" class="block text-sm font-medium text-gray-700">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>
                
                <div>
                    <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                    <input type="text" id="genre" name="genre" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label for="height" class="block text-sm font-medium text-gray-700">Height (e.g., 175 cm)</label>
                    <input type="text" id="height" name="height" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight (e.g., 70 kg)</label>
                    <input type="text" id="weight" name="weight" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <button type="submit" class="w-full bg-purple-500 text-white font-bold py-2 px-4 rounded-md hover:bg-purple-600 transition duration-200">
                    Add Singer
                </button>
            </form>
        </div>

    </div>

</body>
</html>
