<?php

use Gemini\Enums\ModelType;
use Gemini\Enums\ModelVariation;

$yourApiKey = getenv('GEMINI_API_KEY');
$client = Gemini::client($yourApiKey);

$result = $client->geminiPro()->generateContent('Hello');
$result->text(); // Hello! How can I assist you today?

// Custom Model
$result = $client->geminiPro()->generativeModel(model: 'models/gemini-1.5-flash-001');
$result->text(); // Hello! How can I assist you today?


// Enum usage
$result = $client->geminiPro()->generativeModel(model: ModelType::GEMINI_FLASH);
$result->text(); // Hello! How can I assist you today?


// Enum method usage
$result = $client->geminiPro()->generativeModel(
model: ModelType::generateGeminiModel(
variation: ModelVariation::FLASH,
generation: 1.5,
version: "002"
), // models/gemini-1.5-flash-002
);
$result->text(); // Hello! How can I assist you today?
