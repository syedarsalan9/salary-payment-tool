<?php

namespace App\Contracts;

interface FileExportInterface
{
    public function export(array $data, string $year): string;
}