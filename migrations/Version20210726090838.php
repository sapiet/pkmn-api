<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726090838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO `pokemon` (`id`, `name`, `spawn_percentage`, `spawn_duration`) VALUES
            (1, \'Bulbizarre\', 6900, 300),
            (2, \'Herbizarre\', 420, 120),
            (3, \'Florizarre\', 170, 120),
            (4, \'Salamèche\', 2530, 300),
            (5, \'Reptincel\', 120, 120),
            (6, \'Dracaufeu\', 31, 120),
            (7, \'Carapuce\', 5800, 300),
            (8, \'Carabaffe\', 340, 120),
            (9, \'Tortank\', 67, 120),
            (10, \'Chenipan\', 30320, 180),
            (11, \'Chrysacier\', 1870, 120),
            (12, \'Papilusion\', 220, 120),
            (13, \'Aspicot\', 71200, 180),
            (14, \'Coconfort\', 4400, 120),
            (15, \'Dardargnan\', 509, 120),
            (16, \'Roucool\', 159800, 180),
            (17, \'Roucoups\', 10200, 120),
            (18, \'Roucarnage\', 1300, 120),
            (19, \'Rattata\', 130500, 180),
            (20, \'Rattatac\', 4100, 120),
            (21, \'Piafabec\', 47300, 120),
            (22, \'Rapasdepic\', 1500, 120),
            (23, \'Abo\', 22700, 120),
            (24, \'Arbok\', 720, 120),
            (25, \'Pikachu\', 2100, 120),
            (26, \'Raichu\', 76, 120),
            (27, \'Sabelette\', 11100, 120),
            (28, \'Sablaireau\', 370, 120),
            (29, \'Nidoran♀\', 13800, 120),
            (30, \'Nidorina\', 880, 120),
            (31, \'Nidoqueen\', 120, 120),
            (32, \'Nidoran♂\', 13100, 120),
            (33, \'Nidorino\', 830, 120),
            (34, \'Nidoking\', 170, 120),
            (35, \'Mélofée\', 9200, 120),
            (36, \'Mélodelfe\', 120, 120),
            (37, \'Goupix\', 2200, 120),
            (38, \'Feunard\', 77, 120),
            (39, \'Rondoudou\', 3900, 120),
            (40, \'Grodoudou\', 180, 120),
            (41, \'Nosferapti\', 65200, 120),
            (42, \'Nosferalto\', 4200, 120),
            (43, \'Mystherbe\', 10200, 120),
            (44, \'Ortide\', 640, 120),
            (45, \'Rafflesia\', 97, 120),
            (46, \'Paras\', 23600, 120),
            (47, \'Parasect\', 740, 120),
            (48, \'Mimitoss\', 22800, 120),
            (49, \'Aéromite\', 720, 120),
            (50, \'Taupiqueur\', 4000, 120),
            (51, \'Triopikeur\', 140, 120),
            (52, \'Miaouss\', 8600, 120),
            (53, \'Persian\', 220, 120),
            (54, \'Psykokwak\', 25400, 120),
            (55, \'Akwakwak\', 869, 120),
            (56, \'Férosinge\', 9200, 120),
            (57, \'Colossinge\', 310, 120),
            (58, \'Caninos\', 9200, 120),
            (59, \'Arcanin\', 170, 120),
            (60, \'Ptitard\', 21900, 120),
            (61, \'Têtarte\', 1300, 120),
            (62, \'Tartard\', 110, 120),
            (63, \'Abra\', 4200, 120),
            (64, \'Kadabra\', 270, 120),
            (65, \'Alakazam\', 73, 120),
            (66, \'Machoc\', 4900, 120),
            (67, \'Machopeur\', 340, 120),
            (68, \'Mackogneur\', 68, 120),
            (69, \'Chétiflor\', 11500, 120),
            (70, \'Boustiflor\', 720, 120),
            (71, \'Empiflor\', 59, 120),
            (72, \'Tentacool\', 8100, 120),
            (73, \'Tentacruel\', 819, 120),
            (74, \'Racaillou\', 11900, 120),
            (75, \'Gravalanch\', 710, 120),
            (76, \'Grolem\', 47, 120),
            (77, \'Ponyta\', 5100, 120),
            (78, \'Galopa\', 110, 120),
            (79, \'Ramoloss\', 10500, 120),
            (80, \'Flagadoss\', 360, 120),
            (81, \'Magnéti\', 7100, 120),
            (82, \'Magnéton\', 229, 120),
            (83, \'Canarticho\', 212, 120),
            (84, \'Doduo\', 5200, 120),
            (85, \'Dodrio\', 2200, 120),
            (86, \'Otaria\', 2800, 120),
            (87, \'Lamantine\', 130, 120),
            (88, \'Tadmorv\', 520, 120),
            (89, \'Grotadmorv\', 31, 120),
            (90, \'Kokiyas\', 5200, 120),
            (91, \'Crustabri\', 150, 120),
            (92, \'Fantominus\', 7900, 120),
            (93, \'Spectrum\', 520, 120),
            (94, \'Ectoplasma\', 67, 120),
            (95, \'Onix\', 1000, 120),
            (96, \'Soporifik\', 32100, 120),
            (97, \'Hypnomade\', 1000, 120),
            (98, \'Krabby\', 21200, 120),
            (99, \'Krabboss\', 620, 120),
            (100, \'Voltorbe\', 6500, 120),
            (101, \'Électrode\', 200, 120),
            (102, \'Noeunoeuf\', 7800, 120),
            (103, \'Noadkoko\', 140, 120),
            (104, \'Osselait\', 6100, 120),
            (105, \'Ossatueur\', 200, 120),
            (106, \'Kicklee\', 200, 120),
            (107, \'Tygnon\', 220, 120),
            (108, \'Excelangue\', 110, 120),
            (109, \'Smogo\', 2000, 120),
            (110, \'Smogogo\', 160, 120),
            (111, \'Rhinocorne\', 6300, 120),
            (112, \'Rhinoféros\', 220, 120),
            (113, \'Leveinard\', 130, 120),
            (114, \'Saquedeneu\', 2280, 120),
            (115, \'Kangourex\', 86, 120),
            (116, \'Hypotrempe\', 11300, 120),
            (117, \'Hypocéan\', 340, 120),
            (118, \'Poissirène\', 21800, 120),
            (119, \'Poissoroy\', 800, 120),
            (120, \'Stari\', 19500, 120),
            (121, \'Staross\', 340, 120),
            (122, \'M. Mime\', 31, 120),
            (123, \'Insécateur\', 1400, 120),
            (124, \'Lippoutou\', 3500, 120),
            (125, \'Élektek\', 740, 120),
            (126, \'Magmar\', 1000, 120),
            (127, \'Scarabrute\', 9900, 120),
            (128, \'Tauros\', 1200, 120),
            (129, \'Magicarpe\', 47800, 600),
            (130, \'Léviator\', 32, 600),
            (131, \'Lokhlass\', 60, 600),
            (132, \'Métamorph\', 1, 120),
            (133, \'Évoli\', 27500, 360),
            (134, \'Aquali\', 140, 360),
            (135, \'Voltali\', 120, 360),
            (136, \'Pyroli\', 170, 120),
            (137, \'Porygon\', 120, 120),
            (138, \'Amonita\', 1400, 120),
            (139, \'Amonistar\', 61, 120),
            (140, \'Kabuto\', 1000, 120),
            (141, \'Kabutops\', 32, 120),
            (142, \'Ptéra\', 180, 120),
            (143, \'Ronflex\', 160, 600),
            (144, \'Artikodin\', 1, 600),
            (145, \'Électhor\', 1, 600),
            (146, \'Sulfura\', 1, 600),
            (147, \'Minidraco\', 3000, 120),
            (148, \'Draco\', 200, 120),
            (149, \'Dracolosse\', 11, 600),
            (150, \'Mewtwo\', 1, 480),
            (151, \'Mew\', 1, 480)');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 6900 WHERE id = 1');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 420 WHERE id = 2');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 170 WHERE id = 3');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 2530 WHERE id = 4');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 120 WHERE id = 5');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 31 WHERE id = 6');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 5800 WHERE id = 7');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 340 WHERE id = 8');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 67 WHERE id = 9');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 30320 WHERE id = 10');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1870 WHERE id = 11');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 220 WHERE id = 12');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 71200 WHERE id = 13');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 4400 WHERE id = 14');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 509 WHERE id = 15');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 159800 WHERE id = 16');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 10200 WHERE id = 17');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1300 WHERE id = 18');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 130500 WHERE id = 19');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 4100 WHERE id = 20');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 47300 WHERE id = 21');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1500 WHERE id = 22');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 22700 WHERE id = 23');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 720 WHERE id = 24');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 2100 WHERE id = 25');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 76 WHERE id = 26');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 11100 WHERE id = 27');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 370 WHERE id = 28');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 13800 WHERE id = 29');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 880 WHERE id = 30');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 120 WHERE id = 31');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 13100 WHERE id = 32');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 830 WHERE id = 33');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 170 WHERE id = 34');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 9200 WHERE id = 35');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 120 WHERE id = 36');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 2200 WHERE id = 37');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 77 WHERE id = 38');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 3900 WHERE id = 39');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 180 WHERE id = 40');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 65200 WHERE id = 41');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 4200 WHERE id = 42');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 10200 WHERE id = 43');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 640 WHERE id = 44');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 97 WHERE id = 45');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 23600 WHERE id = 46');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 740 WHERE id = 47');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 22800 WHERE id = 48');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 720 WHERE id = 49');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 4000 WHERE id = 50');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 140 WHERE id = 51');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 8600 WHERE id = 52');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 220 WHERE id = 53');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 25400 WHERE id = 54');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 869 WHERE id = 55');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 9200 WHERE id = 56');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 310 WHERE id = 57');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 9200 WHERE id = 58');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 170 WHERE id = 59');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 21900 WHERE id = 60');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1300 WHERE id = 61');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 110 WHERE id = 62');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 4200 WHERE id = 63');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 270 WHERE id = 64');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 73 WHERE id = 65');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 4900 WHERE id = 66');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 340 WHERE id = 67');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 68 WHERE id = 68');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 11500 WHERE id = 69');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 720 WHERE id = 70');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 59 WHERE id = 71');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 8100 WHERE id = 72');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 819 WHERE id = 73');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 11900 WHERE id = 74');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 710 WHERE id = 75');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 47 WHERE id = 76');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 5100 WHERE id = 77');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 110 WHERE id = 78');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 10500 WHERE id = 79');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 360 WHERE id = 80');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 7100 WHERE id = 81');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 229 WHERE id = 82');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 212 WHERE id = 83');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 5200 WHERE id = 84');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 2200 WHERE id = 85');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 2800 WHERE id = 86');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 130 WHERE id = 87');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 520 WHERE id = 88');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 31 WHERE id = 89');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 5200 WHERE id = 90');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 150 WHERE id = 91');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 7900 WHERE id = 92');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 520 WHERE id = 93');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 67 WHERE id = 94');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1000 WHERE id = 95');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 32100 WHERE id = 96');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1000 WHERE id = 97');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 21200 WHERE id = 98');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 620 WHERE id = 99');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 6500 WHERE id = 100');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 200 WHERE id = 101');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 7800 WHERE id = 102');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 140 WHERE id = 103');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 6100 WHERE id = 104');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 200 WHERE id = 105');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 200 WHERE id = 106');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 220 WHERE id = 107');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 110 WHERE id = 108');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 2000 WHERE id = 109');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 160 WHERE id = 110');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 6300 WHERE id = 111');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 220 WHERE id = 112');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 130 WHERE id = 113');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 2280 WHERE id = 114');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 86 WHERE id = 115');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 11300 WHERE id = 116');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 340 WHERE id = 117');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 21800 WHERE id = 118');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 800 WHERE id = 119');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 19500 WHERE id = 120');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 340 WHERE id = 121');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 31 WHERE id = 122');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1400 WHERE id = 123');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 3500 WHERE id = 124');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 740 WHERE id = 125');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1000 WHERE id = 126');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 9900 WHERE id = 127');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1200 WHERE id = 128');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 47800 WHERE id = 129');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 32 WHERE id = 130');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 60 WHERE id = 131');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1 WHERE id = 132');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 27500 WHERE id = 133');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 140 WHERE id = 134');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 120 WHERE id = 135');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 170 WHERE id = 136');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 120 WHERE id = 137');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1400 WHERE id = 138');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 61 WHERE id = 139');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1000 WHERE id = 140');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 32 WHERE id = 141');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 180 WHERE id = 142');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 160 WHERE id = 143');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1 WHERE id = 144');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1 WHERE id = 145');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1 WHERE id = 146');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 3000 WHERE id = 147');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 200 WHERE id = 148');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 11 WHERE id = 149');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1 WHERE id = 150');
        $this->addSql('UPDATE pokemon SET spawn_percentage = 1 WHERE id = 151');
    }

    public function down(Schema $schema): void
    {
    }
}
