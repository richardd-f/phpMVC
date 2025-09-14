<?php

require_once("../../model/Singer.php");
$singer = new Singer();
$singer_list = $singer->getAllSingers() ?? [];


$isEdit = isset($_GET["edit"]);
$actionUrl = $isEdit 
    ? "../../controller/Singer.php?action=edit&id=" . $_GET["singer_id"]
    : "../../controller/Singer.php?action=add";

$formTitle = $isEdit ? "Edit Singer" : "Add New Singer";
$buttonText = $isEdit ? "Save Changes" : "Add Singer";

$prefName = $isEdit ? ($_GET["name"] ?? "") : "";
$prefBirthDate = $isEdit ? ($_GET["birthDate"] ?? "") : "";
$prefGenre = $isEdit ? ($_GET["genre"] ?? "") : "";
$prefHeight = $isEdit ? ($_GET["height"] ?? "") : "";
$prefWeight = $isEdit ? ($_GET["weight"] ?? "") : "";

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
                    <?php if (!empty($singer_list)): ?>
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
                                        <a href="/controller/Singer.php?action=edit&id=<?php echo $singer["singer_id"]; ?>" 
                                        class="inline-flex items-center justify-center bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.75 20.902l-4.5 1.125 1.125-4.5L16.862 4.487z" />
                                            </svg>
                                        </a>
                                        <!-- Delete Button -->
                                        <a href="/controller/Singer.php?action=delete&id=<?php echo $singer["singer_id"]; ?>" 
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
                            <td colspan="6" class="p-4 text-center text-gray-500 italic">
                                No singers found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <hr class="my-8 border-gray-300">

        <!-- Add/Edit Singer Form -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-4"><?php echo $formTitle; ?></h2>
            <form action="<?php echo $actionUrl; ?>" method="POST" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input required type="text" id="name" name="name" 
                        value="<?php echo htmlspecialchars($prefName); ?>"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label for="birthDate" class="block text-sm font-medium text-gray-700">Birthdate</label>
                    <input required type="date" id="birthDate" name="birthDate" 
                        value="<?php echo htmlspecialchars($prefBirthDate); ?>"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>
                
                <div>
                    <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                    <input required type="text" id="genre" name="genre" 
                        value="<?php echo htmlspecialchars($prefGenre); ?>"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label for="height" class="block text-sm font-medium text-gray-700">Height (e.g., 175 cm)</label>
                    <input required type="number" id="height" name="height" 
                        value="<?php echo htmlspecialchars($prefHeight); ?>"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight (e.g., 70 kg)</label>
                    <input required type="number" id="weight" name="weight" 
                        value="<?php echo htmlspecialchars($prefWeight); ?>"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                </div>

                <button type="submit" 
                        class="w-full bg-purple-500 text-white font-bold py-2 px-4 rounded-md hover:bg-purple-600 transition duration-200">
                    <?php echo $buttonText; ?>
                </button>
            </form>
        </div>

    </div>

</body>
</html>
