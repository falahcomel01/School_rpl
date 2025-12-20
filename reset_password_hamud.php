<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(abstract: 'Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== RESET PASSWORD USER HAMUD ===\n\n";

// Cari user
$user = \App\Models\User::where('email', 'hamud@gmail.com')->first();

if (!$user) {
    echo "❌ User tidak ditemukan\n";
    exit;
}

echo "User ditemukan: {$user->name} ({$user->email})\n";
echo "Password hash lama: {$user->password}\n\n";

// Set password baru - LANGSUNG tanpa bcrypt karena mutator akan handle
$passwordBaru = 'hamud123';
$user->password = $passwordBaru;
$user->save();

echo "✓ Password berhasil direset!\n";
echo "Password baru: {$passwordBaru}\n";
echo "Password hash baru: {$user->password}\n\n";

// Test password baru
$testResult = \Illuminate\Support\Facades\Hash::check($passwordBaru, $user->password);
echo "Test password: " . ($testResult ? "✓ BERHASIL" : "✗ GAGAL") . "\n";
