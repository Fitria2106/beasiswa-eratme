<?php
return [
    "show_warnings" => false,
    "public_path" => public_path(),
    "orientation" => "portrait",
    "default_paper_size" => "a4",
    "default_font" => "serif",
    "dpi" => 96,
    "enable_php" => false,
    "enable_javascript" => true,
    "enable_remote" => false, // Ini yang paling penting untuk Logo
    "isRemoteEnabled" => false, // Duplikasi untuk memastikan terbaca
    "enable_html5_parser" => true,
    "isHtml5ParserEnabled" => true,
    "isFontSubsettingEnabled" => true,
    "debugPng" => false,
    "debugKeepTemp" => false,
    "debugCss" => false,
    "debugLayout" => false,
    "debugLayoutLines" => true,
    "debugLayoutBlocks" => true,
    "debugLayoutInline" => true,
    "debugLayoutPaddingBox" => true,
    "pdf_backend" => "CPDF",
    "font_dir" => storage_path('fonts'),
    "font_cache" => storage_path('fonts'),
    "temp_dir" => sys_get_temp_dir(),
    "chroot" => realpath(base_path()),
];