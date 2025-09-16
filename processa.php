<?php

$arq = file_get_contents("./PS2_Games.json");
if ($arq === false) {
    die("Erro ao ler o arquivo.");
}
$ps2g = json_decode($arq);
if ($ps2g === null) {
    die("Erro ao decodificar JSON: " . json_last_error_msg());
}
$games = $ps2g->jogos_ps2;
// -1 = sem limite
$year_minimum_filter = -1;
$year_maximum_filter = -1;

$title_filter = "God of";
$dev_filter = "Santa Monica";
$genre_filter = "Ação";


$filtered = array_filter($games, function ($game) use ($year_minimum_filter, $year_maximum_filter, $title_filter, $dev_filter, $genre_filter) {
    return
        ($year_maximum_filter === -1 || $game->ano <= $year_maximum_filter) &&
        ($year_minimum_filter === -1 || $game->ano >= $year_minimum_filter) &&
        str_contains(strtolower($game->titulo), strtolower($title_filter)) &&
        str_contains(strtolower($game->desenvolvedora), strtolower($dev_filter)) &&
        str_contains(strtolower($game->genero), strtolower($genre_filter));
});

print_r($filtered);
