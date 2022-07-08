<?php

namespace achedon\statistiques\commands;

use  achedon\statistiques\UI\PlayerStatsUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class stats extends Command {

    public function __construct()
    {
        parent::__construct(
            "stats",
            "voir ses stat sur le serveur",
            "/stats"
        );

    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player){
            return;
        }
        PlayerStatsUI::player($sender);
    }
}
