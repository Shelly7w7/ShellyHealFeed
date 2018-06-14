<?php

namespace ShellyHealFeed;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class Main extends PluginBase{

	private const PREFIX = "§l§5ShellyHeal > §r§c";

	/**
	 * @param CommandSender $sender
	 * @param Command       $cmd
	 * @param string        $label
	 * @param array         $args
	 * @return bool
	 */
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		switch(strtolower($cmd->getName())){
			case "heal":
				if($sender instanceof Player){
					if($sender->hasPermission("shellyheal.command")){
						if(empty($args[0])){
							$sender->setHealth(20);
							$sender->addTitle(TextFormat::RED . "Healed");
							$sender->sendMessage(self::PREFIX . "You have been healed!");
							return false;
						}
						$player = $this->getServer()->getPlayer($args[0]);
						if($player){
							$player->setHealth(20);
							$player->addTitle(TextFormat::RED . "Healed");
							$player->sendMessage(self::PREFIX . "You have been healed!");
							$sender->sendMessage(self::PREFIX . "You have healed " . $player->getName());
						}else{
							$sender->sendMessage(self::PREFIX . TextFormat::RED . "Player not found");
							return false;
						}
					}else{
						$sender->sendMessage(self::PREFIX . "You do not have permission to use this command");
						return false;
					}
				}else{
					$sender->sendMessage(self::PREFIX . "Use this command in-game!");
					return false;
				}
				break;
			case "feed":
				if($sender instanceof Player){
					if($sender->hasPermission("shellyfeed.command")){
						if(empty($args[0])){
							$sender->setFood(20);
							$sender->setSaturation(20);
							$sender->addTitle(TextFormat::RED . "Fed");
							$sender->sendMessage(self::PREFIX . "You have been fed!");
							return false;
						}
						$player = $this->getServer()->getPlayer($args[0]);
						if($player){
							$player->setFood(20);
							$player->setSaturation(20);
							$player->addTitle(TextFormat::RED . "Fed");
							$player->sendMessage(self::PREFIX . "You have been fed!");
							$sender->sendMessage(self::PREFIX . "You have fed " . $player->getName());
						}else{
							$sender->sendMessage(self::PREFIX . "Player not found");
							return false;
						}
					}else{
						$sender->sendMessage(self::PREFIX . "You do not have permission to use this command");
						return false;
					}
				}else{
					$sender->sendMessage(self::PREFIX . "Use this command in-game!");
					return false;
				}
				break;
		}
		return true;
	}
}