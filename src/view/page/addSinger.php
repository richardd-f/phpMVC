<?php

require_once("../../model/Singer.php");
$singer = new Singer();
$singer_list = $singer->getAllSingers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Singer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <?php require_once("../nav.php")?>

    <div class="max-w-5xl mx-auto p-4 sm:p-6 md:p-8">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">List Singer</h1>

        <!-- Singer Table -->
        <div class="shadow-md rounded-lg overflow-hidden overflow-x-auto">
            <table class="min-w-full text-left bg-white">
                <thead class="bg-purple-500 text-white">
                    <tr>
                        <th class="p-4 font-semibold text-sm uppercase">Name</th>
                        <th class="p-4 font-semibold text-sm uppercase">Birthdate</th>
                        <th class="p-4 font-semibold text-sm uppercase">Genre</th>
                        <th class="p-4 font-semibold text-sm uppercase">Height</th>
                        <th class="p-4 font-semibold text-sm uppercase">Weight</th>
                        <th class="p-4 font-semibold text-sm uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($singer_list as $index => $singer): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['name']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['birthDate']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['genre']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['height']); ?></td>
                            <td class="p-4 text-gray-700"><?php echo htmlspecialchars($singer['weight']); ?></td>
                            <td class="p-4">
                                <div class="flex justify-center items-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="?action=edit&id=<?php echo $index; ?>" 
                                       class="inline-flex items-center justify-center bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.75 20.902l-4.5 1.125 1.125-4.5L16.862 4.487z" />
                                        </svg>
                                    </a>
                                    <!-- Delete Button -->
                                    <a href="?action=delete&id=<?php echo $index; ?>" 
                                       class="inline-flex items-center justify-center bg-red-500 text-white p-2 rounded-md hover:bg-red-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr class="my-8 border-gray-300">

        <!-- Add Singer Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add New Singer</h2>
            <form action="../../controller/Singer.php?action=add" method="POST" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label for="birthDate" class="block text-sm font-medium text-gray-700">Birthdate</label>
                    <input type="date" id="birthDate" name="birthDate" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
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
