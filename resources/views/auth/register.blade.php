<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @livewireStyles
    {{-- <livewire:register /> --}}

    <style>
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            background-color: #3b47b6;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #3b7bb6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form wire:submit.prevent="Register">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" wire:model="name" required>
                @error('name') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" wire:model="email" required>
                @error('email') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" wire:model="password" required>
                @error('password') <span>{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation" required>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
    
    @livewireScripts
</body>
</html>
