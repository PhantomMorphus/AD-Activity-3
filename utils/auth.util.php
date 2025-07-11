<?php
function verifyPassword(string $input, string $hash): bool {
    return password_verify($input, $hash);
}

function hashPassword(string $input): string {
    return password_hash($input, PASSWORD_DEFAULT);
}