/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_kepegawaian_rumah_sakit
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_kepegawaian_rumah_sakit` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_kepegawaian_rumah_sakit`;

/*Table structure for table `tb_jabatan` */

DROP TABLE IF EXISTS `tb_jabatan`;

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jabatan` */

insert  into `tb_jabatan`(`id_jabatan`,`nama_jabatan`) values 
(1,'Admin'),
(2,'Direktur'),
(3,'Kepala Bidang'),
(4,'Kepala Ruangan'),
(5,'Pegawai');

/*Table structure for table `tb_pegawai` */

DROP TABLE IF EXISTS `tb_pegawai`;

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_pg` varchar(255) DEFAULT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto_profile` mediumblob DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `negara` varchar(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `golongan_darah` char(3) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `status_kawin` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(16) DEFAULT NULL,
  `file_ktp` blob DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `jenis_kontrak` varchar(255) DEFAULT NULL,
  `bidang` varchar(255) DEFAULT NULL,
  `ruangan` varchar(255) DEFAULT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pegawai`),
  UNIQUE KEY `username` (`username`),
  KEY `id_jabatan` (`id_jabatan`),
  CONSTRAINT `tb_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pegawai` */

insert  into `tb_pegawai`(`id_pegawai`,`id_jabatan`,`username`,`email`,`password_pg`,`nip`,`nama`,`no_hp`,`alamat`,`foto_profile`,`kecamatan`,`kabupaten`,`negara`,`agama`,`jenis_kelamin`,`golongan_darah`,`tempat_lahir`,`tgl_lahir`,`status_kawin`,`no_ktp`,`file_ktp`,`tahun_masuk`,`jenis_kontrak`,`bidang`,`ruangan`,`tgl_buat`) values 
(1,1,'admin','test@gmail.com','$2y$10$muK9xltRI5MxRJwcfozGjepKNMElNZLoArpDumW9tjyv3NeAyEdUy','1','Test','081','Jl. Test','‰PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0d\0\0\0d\0\0\0pâ•T\0\0\0	pHYs\0\0\0\0\0šœ\0\0\0sRGB\0®Îé\0\0\0gAMA\0\0±üa\0\0O\\IDATxÍ½y¤÷yö~GßwOÏ=»;³÷.Ž]€I€\"¹)†4Ë\"˜’ŠvŠG•È‰S\0*©”X•À)U©”XI¤DI™P¥\\RE±	Ú‘i]Ü•“ 	 €={vç¾ú¾¿#Ïóþ¾žE“@ðhp¹³3=Ýß÷{¯ç}ž÷÷kK~ÁgÏ.9—H¸‹bË¡Ð÷‡£p1“tŠ¡H1´¥háyaŠeYâûAýú·¿U÷ü°ê¸qIÄÂKƒQlyáèÒ¥êNÿuù~XòöøøÙE,øè¡TÌ>„Þ97W^ÌÍP|Øƒ—kákÁ×¬`‹jˆÿÙø–ïûríùo‰mÛKÆñ\r<Û·eú®“’ÊæÄ‚jè—zýÞ—“Éä¥?ù“¿¸$¿@W~ç~é½çv×V?e‡ÁCa8\\L¹fÙm{L(æ;øWê?+ú¾5þËÒïâ_ü~×5Úp4«ï ’¬Eüp1îÆ\nF#ùÕO~¨ê‹\\tzø—Ÿ¿(?çÇÏ-BÎŸ¨Øíz¤Ò‰‡:­æÙ×/½,)Û’‰´-Nta>¢ Q¨HzvN,¬6Ökªyø3üÓUÈï[ˆ›ÁPª/½$–ïI,“ÐïãK©_’D2£Æ£a-5¤y-Ñ(³ÅÂªí„OŠ8Ÿ}öbU~Ÿy„œ;÷ÀÙÅCSŸ“Ð9ŸJ¡„¾ .hÚ±™zB“’Œ‹Ãëñ/8ý¾çðç¾ç!\r°øÃ‘MdØb\"(žB¨À\n\\õ`D›izN!_54F	ð|Kðåñœ/†/ï“yÆ‰YOþ¬\ró3‹Ï|æã‹þ(üb\"îž‹Å2ôGX ,ŒH«Ù”ê•«’À‚N&âp…,_9Qš’ÄôŒ.Þk<ø2ÒŽ`ëÎðe„ítºj·•‰;âzüBS\\D@ùèQq)M|\r`™ô§†1ÉP¡Å¯Õ²bãg#oøL,™ü™Æ‘ŸòãÜ¹sÅ÷½ïÄoû¾õÇpÕEú€Cjñéå¾þ=B.oîì‰WNÇŒ—X6kÒW*+’ÎI£9V{ >\ràwñû^ #†ãÂòïá ZâK»Ý×‚\Z(]*#HS‚\"#0éVT,{\\{\\&’otÖ\r-§c‹¹rê¥öO¥ÙòS|<ôÐ¯<29¾¥}ToV¿”dú5“¬•m“eB,(.ÀïøšÛ] \'BZ\ZÆ@T4[méöb\n‹­¿‹æ2\nì˜Ä³Z1xxLúžmŒF‘@Cù&²$J_š}“¸ˆèD„¹b\"µÀ?ŸÃ\'g2çå§øø©Ô‡>prÑ­L~Ñ‰9ç4·«7Zê„=,Â¬6®–ç@‰…[ÿÃs¸~\"\'#‚TÚfÑYsÚ¦\Z¬‡úséº€¼(ò¶£¯Å(±Gâñ$Po\nß“\"+s5M²^™ÿø@´¾~5N[ÚÏ°¶©A¬¨æð\ZeÑ	Ã/¾g¡ð¹˜k=ü\\µ^•wùñ®§¬_yÏ±Gb1ëc‰ôI¬ˆÞc£ØHEŽë\Zd˜H¢87jMI8¶$c„ªI$\'d×wµào{¨ý~_ÿ0Jø²ÍnK†½ž„0Ì\0÷{]<oˆ?=¼Q@8Œ…á˜]¼·E«‚]lsí\ZZCÂÛHL£#@\nlKˆéáZH½¸öó¥t|°Ý=\'ïâã]‹‡Î-æly¼==Jo\n-sÓ&g›;Žl³ŸºLzM;ŸÇe\'¤Ä¥ƒÂ‚*y¤Ç‰I½Ý@ `Ñû=ÄÓúÃ7åë4„æM|F‹åÂ0y9ë»mIv<©³RÌ%$sa‰\"»P¯ÇŠ¾¦\rìý–‡PL¥YH¥Ê1º­\"¢ò©{g³‡^Xo?&ïÒã]1Èù`1ôû_BJ:ëh¸[ÚØZ!°8ðJßóLÁdñ\r£¶oQ(ËÿÚn8™ž.M	éwz\nmÛ5¯áañŒ¶¢ÐÅâ:’€!|\0G¬xíX,.v<¦UËƒq‡=O¶‘¾ˆÎf+Y,:bFë¯ÉŠ\nªmjŒ¢¬PëN ã¨1ÿö#2ÙÆCëÑ3Sé‡RéøƒïF\nû‰\ròqÔøç×–EOk€iØbq¼tÒE£æ¡{Ú|±š8–m?ÜÙ±DŽr®ÂxQ¬l^òù‚þÛ÷×ö¹0;piy\\*¹˜R	)ä22Q*H)—ÖªPëvec·)mDGÏÕ·¦c;qíMÃ¡lmuôµg\'³âF\0‚æÐuÖ„¦?1Zïx­V„¾ô9¶¾0˜¾èÈèÂ¹“Å/¾þ“å\'2ÒÔYÜØ…Ð÷ŠäŽà‡û¥’ÄC?øá£¦zWŒÍeÒ¹qx:ú©ù,œ‹BmšC½ŠÇÃÂ[=í¾Sq[f§\'äÄ\\IL–¥”ÍJŽ=VÌÃë¶‘ã¯—šòÊÊ¦¬\"Mõ#5ú¿‡éï}øííšÄ@¦*9…×†eJ\Z5Aƒ}ý£X,‚ƒQ¿Ÿ†Yðýÿâ‹™¿^í¼c~ìõ¿ÿ+÷ÅR^\0XL#\ZÔƒ‚Pû½æTF æñÀ7† ÇD°¹QwíékyX´zl¾(©TRÏÁ[í–ó€Fv%i\råîù¢|øô!9s`FŽÎTd*›”<HÄV&Ž‹È xOf’2…ZÁUê´Ú]éõúxÏ‘är\\Œ„”×Á÷RéR›#ãþv«lkch\"}v» ÀPÙ˜m«y‰ÑŸà÷’HŸYšOÿYu»¿!ïàñŽòÐ¹ûÎâB. ŠôúTÜÒæ‹_Ú+ˆ/Bo·`—éKÛcC‘»±žk\nsD”H¶0Á6Páe<–Q a¾\0k\'“–<plF@†\\šœ”É|06†ÅqîZdwimÍ8òbÓùŒa\Zb¯Õ“{ðU00Ð˜ïébYCÝŒaFÔ8j$¾\Z°ßå}0ŽeÒÙ÷c°M„ò5ß?3—OýÙ­úÛ7ÊÛNY¡€Ë`t‹PÓ@±ÐiA\r^·€HX€]Üü`HHéµé\nBÙo™˜yƒ„¦ì	|,ÖFH!uYý®œœÎÈ™C3rd¦,HQ	7&Œá\0Iñ{x¾íÄÔ!B{`ú¼NéíðdˆÊV\'yþú\Z:þ†ä2qD¨ûRºÿ`s*îìûZ¾÷‘¡é‘$*êaD·D‡³\"ÌŠò—Ö= ëÂ¹œ¼çâs¯Wåm<ÞV„ÐöÈ¿€K˜{;m’™¦MSV vAÊJ©‚¡F{SÞµÑôisè›Ýq“øÛÕ{zRÇ¢õ;mÉÂ“ùô‚¼ïÈ¼›Ÿ”©|V2é¤$“)qa\0È0¤aœ˜)´pÏƒ¯kLqÐ`7·öÐ»ô‘zH¹à©xn‘˜A¥Sqs“\rÌ¥(‘4èô5¹®mës	]sëøÛP/ŠÒlEšÉÔDù¡c\'ùêÕ•·L·¼-ê\rØ ‹E³Â¦i„Z\0ÇÏ²ÙšA:‹§‹Æ§*çd¬cE—¾\n´?À[[Ònµ\0i0²+w/LÊý§«1&‹9 ¯¼$Si 0W(SP\rÄÞo=-Ói³Œ–Æ³aÌ„Áë0%xl=rbL?ŽÔêÜF¥;Ã£	Qex2¢^»¾Ý6µ#Ó÷lU¬è:,mRs­ü~÷Kç z¾Õ5~ËùŸøàS‰Xl‘ØÞaÊ`ÞfÞµ-][;)z—gþL1÷PT™†Æ4ÅXc¢ýÅXAT¸á¶Y¤¤$Þ#ƒºsæø!™*å%¥/•L«aÕs\rNÕºaÃE¹àÚÔéb~ŒO±Ûdv’F)¤¥œOéu°/òü>;<)¯‹ª‘OhÒP0fƒC#+„×ÞxahE=Šoœ”Æ\ZÓ3X–³©Jåñ·ºÎoÉ ŸýìCØ±Bd8wÂ…IÄ¢|\Z½¹:þ¶]Óýê?Í\"±ù2ð1§ã¨ù2íÕ5F‹<þ‰¸PÎLÈ¡©’$Ùø9NT`]H?2 A‹²\nLL(¾(@Êw1½~‘Ñû•ÓŽLäÆ¯gä‡k¬LäÕ¡hŒˆ41B˜	k‰ØÐýÅ6Xï˜´\"Àr;7G†\nÂÈÐþ£¼ÿÔ£oe­¬A>sþ¡E®\'âé„¸hô\0+„PÂx«•dLAD)ˆðÖaÞ¶ÇhØŒ¡¥¹q†}dáÔõÕ@,°w.TÐü¥`{¼ÞhËDg¨ö1>ƒ\'³–¸@fI@ç$èú8:ýX,	D•ÅÙ¤üñ¼é|ZVòÃk&‰ñ”3IÃ¹L\Zµ5#ßÙ§R45…¦;4·êD1ci3¾g“®BMYÊHˆÉÀ&’J¸üãgÜzÿX”•Še¾8\nûÅ€^NCð‚áúK=ß+ú?¼g¡KÇÁK!ŠàÉªÙ©¥Ì{@Mö˜Ó\nÍx€’\\ÇŽ«·-Nå½Ç`˜˜ÞÑ„!;ëX\"‰…Ï0¶’’IÀ9PÜQÈözà³&Ž(êÇ‡\nQ}©KgP“!”´Ê‘©²¼±ÒÍà5ÀD6›2µÈŠh‰Ro´äÑzð¾ÕÁè“¡i\"Õx†ÄÖÅw¬è÷#uÒ’q‘¢xÎñÍß±AÎÿãÏž‡ƒs\0G™\r,­¸+®Æ¢>„ê5¶8QÕ|:ú\\Íbxd:+§î¾[ƒ·Q«ÉÍå›²¹±eî$Z€(ó4r|ÚJH-i¨fo\0r0&]xÝ¨À›ÑÕ»,´žQŠZZú0ÚÐÐ+7×e¯Ù3)îjƒ‚	ÎÀ¾™dLNÍdçò6¨K&\'Kz¯†–·’¸ßDÑŒåd[ÁŠ„Q4Íný†E­þ÷o[og´b:æ¹þò½þåW_xúmäüùÏ,&bîã.¼ÔƒùiyÝuý®=\n;t>ƒhƒ,tý£ÔåÀh“ù	…¸}\ZF‹”b±¬J_½ÑP^‰9šã;ìè‰žò€Ÿó¥œÂå=¨~a¨h¨\rM¤ÕB”\Z¢®Äd®œ“	¤Ð„Éfª­ïõ†²	ÄTÆ¢Ï£SO@*V*Æîs²¾µ¥ £ÄæÊ†Ä!O&ã·—Àhù3N¿c ÂNŽgèËÀ]Õ‹#’tL\ZE©ËøbŽhÏ21âÛŸ=»øÌ¥KÕúÛ2H:“|k²È0wÝPíA¯©0ÑÂÕô»è\"ÈÜE/cI40€ËP:\regk7áËr5†Ž8ƒäÁ%\rU­Y”CBå@1NÆÈcÅª\\½™nf±Æ\"öav.\0\Z„]vQÂ·eB0¼#íÈ‹ItÏY^h*x.R$\rŸ€×TŠ©5êZCx_ÞËŽ¢Ãôu·™^C,ŠõZÜ‘%B“¦	xOúˆúF¦¨Ð1}‹Ço8AšL[ ´}õ¿ùØ[6È£þæ\"8ªó=xs7•>!ÏÇù<	iÔ0é´¯+DFA\ZK¡ÿ¨5Z2€a Xê)ŸT¯·\03cêÕlUQÄ×Ré¶!ôèí|iR\Z†Âï}mÖQƒðz6®+9ˆ¦	p` ’FA†n+µÞÄk]zõ–ÜBZœR‹#½ÍO”\'cS™ø’KÒAòÞ™\"k$ÕÖ@{ß³Âñ½™â=îoJ,W±Š±¦¶ê:øFè2†µ£ß·¢ô¦Íå£gOÎ|áÒëÕ·d\0ÂÇYy]\"%D€‡\"Iþ†žO€ÁÅáq=1z‚A&AÔÝ\Zu±ø=,Ž‹ß‹³¸²âfšÃ–~Í× “Ëbü÷ß{R8zP¾»º+ÏÝÚC0F”\'IZ5¹qsK†Å¹ðú†T¯_“ßsJfØàÔsã&ñhEL<¿P7ÃÔº#‡—ŽIíæ5éÁh)\"1ü‰¹=)q}Mçd\nÎƒHÝÄ\ZwUŽôu1ÑDF	\"ZžÔ†wÛÞ×uh,’ ®«}GE&}«ƒF\rk•\'C ûÿÁÿùÍßDtXÁy½mMIäö6» â\0…<“N1Õ#jŒÛ#®â¨²ÇH¡‰P]@ËRS”Òð:q‚\"ä=Ó9É!ì=\'áÁ7x±ú»\"0_õŽ¨í½Kór$Ÿ”¹©)qG]0¬¶¦³Žb©Ó¸ )‹ˆž‘Ü7_‘3ÓR€Rž›ÒæpÝA=Am”	DÖÒ§<¥5\'Q.QªK»fAmÙ\'äD­bºq‘}#X?oPU±V$3øã¾xÌ˜qöÊêö¥iÔy<DñÕN—Þ7j‚Ò Òê\"§‚:à™ìˆP4XÝH¶¶þ	µ®ô:- \næiÆ`Ä¢N;bÄµZ\0Ç’6´ô˜ê!ÔºO“Á%–ÌOLH÷Òn5åH‘çæµ!Ë”Š’M\0É(¡ékÔ%©›³aK¤ðoWra‚ñ-~*©M ÓmˆZÃú‹Û\nsø=]½×2Qnxª@û\r#«ûû0XEÛú¾âoúÛ*¨j–é[4ZƒÌŸ)ÃÆHÄWålì<žùè÷g§7=ý­Ga¢óôkFG^Ô–ÏdÒ:;UÌåÔËs™Œd39ï˜µ7‰ºS^–#Ê\rQóàµáÁ‚9”È‡LpTvAµ8Àçã9ÃfÝ 1<ÇøÉDæÿt–R1%Óe_ëÔ_ˆý#\Z_& Ä®²ÇlãxÏ$Š|\"µ´ ß«©».w‡¾Â÷1%Bè®•Q4hÞ¦}Æœ\\ERTÿ#”ÕÉ†\n£ôÁ¢OéÑPGþçþ6Ïõ}±ýá¹qÒ7¸È$Ò“\\RéJ¹+üŒQ£L¢\ZP¢Ç›r˜4ítFf\n—faœ˜£‚¼™6ÒÄ7ªkh™m©¯m¢`SŒ›Å§uù¢([HÁ!’:þ‹Gšž\'Û©AE#\ZÆÕ´Æ3æ\ZÉÕäŒP\n™œ*«v{8nÏ£Åc¤Y¶ºt4Îjà¹BW±¢•»m3X\'·©š¨AÔõ±Þ´Ì¡¹ÆÐ0Ån·ÿÃ#Çíˆ>ˆ	å³i¤0@ÆdR_›´sÑÒ…jÆ™\'õËä×¨w2âT¶;z6møAFà÷F@Kd[YG`o ´¿É @1«P™\"Í ‰Ò|±È8»¸Ë¾Ã“sZ:HÀàP/wŒ¼DêV	O²Ín¤úä¿†Z»èéT9Du=`¼	\riê!\ZÊ!Ó±²ûQÇnKDï«3F)lŒÒBYKõïÀLaê9K™ÃQ§Àt.ÁðSÿAƒüÆo|æœÍQÏ1%Ž?\r`ÿ‘gdÙ&hqz\\£Ñ”d\"¦k8†‚¡y)sÆ;8Åù]+*xÔÇ{€ÎC¤¯ÑÈ‚Y³ïvú²ÝhK¦\\¿c¤ÒŠ¯\Zžƒ	Úÿê4„¡Ã=¼dÎH)íÍRÈ4h¹:ñBÍÂ¢úfˆFo4R\n†*!g¶Xë8ˆÁ×!\ZŒÂ{ŸN7·aGY Ê¯ûOØïå\ry‹tNÅ™|ß`­AÔ(Ž™aGkáÃøàì3Ùs?`l¾ü9Û$½.¾&ô¥gU\nyeY9wðZ¤Ù¶ö¢Ëcšr5WùÚüqáƒÀôÚ\0â\n†Qï!ÑX§Qã7k-]Ü\\¥¨76Ä¢Ž@¨\nÈˆR×‹\Z0–…ëhZQ‰Bæñu#:j™ÎG:D\rd@~1],(jäÌ×D+“…¢º}G/¢µÿïPÆ¸£@!2…NÓè+ÚÍ*Ïá^óºVÔrqÝœ¬	FXøÐ6?§)ÈqLHé:€»ÜhLúð0Î×2Ý´àÅn,ºyÖm’*\nMªÕŽŒ¹ HÀÑ»2°0ˆ4ÅçøÉ…K¯I ÁAŸsãêƒ\\t2À4†Ñ[¢\\hq1.{;Û²µ¾\"Û[«²º±\ny=Gz¡\r@À/‚‘èF†ŠRL]¬1He¬U-8ÈV·»ÏV’1Z=MéÂCÓÑïS(b¨ûÐô€ê84¾=–~±ŽF+rL:´]M—&Å›0á¸ðÛö§¾Ï >ú_žM$ã‹&Ó¹\rmŠ·©ž\Z¨ÏO¡Ð³Ëv\"¨»_?‚ ¢lþ)ü0ºBG#k<˜fÚ>_u\r²¯ÜÜ¯^úž´@&¾øÚe ž¡FƒÎtÙúÖÊ6³Ÿ‰¡ÆìllÀ[²¼±#{\râ†khþ†>ÉG[ðzƒªÎ˜ÚÅ÷D<ÈÅë+ò——oÈŸ¿vUk™!#Û Õ(gEp5Ïþšú\ZŠÑD¹mŠÚ:‘®ŽcÉ(©¦ÆÓÄ#Ø1ÒäåM)à#.ž;Y\\äo*¦ìô»gS™¢yaxÓŽÇu°)â¸šº²@%Ô‘RiB‹UÓ¯OŠÞÐ€\nÓ*ZQ1e7‹îéÅŠ†00k‰ÉZŽþœ7=D­úâÿ{Q*é˜zò1]ÌÎkz¡ÞÁ~†¬Á˜ŒH ©Ë\'2ât‡d`XBtFå@¥YK‰Ä?T:…£ELü]i·°r­f\'bÆóa¶i -3æc¢&\Zk²nÍi¡Lo´“	lóíýM@Œ_S¡5Ï–™zÃtØfb“oàÙL[O«Ar¹ô§tÐÍ7²%;ŠýOey½ž—Õª·¶ÕÉQ`úN¡íEmï\":ò {}n®êEöz…¼Tì\"¬´¿H4\n$\Z}Îd¡¦ÀûÌOëì–m0´ŒB3\"ÊEêD	OùŸÑÈ‰F[ð¼®j3§´4©‚«I|D¨mE”Ï¸R¯órQA\' $ÊÁíçÑpöXjˆ˜\n‘}~ÏŠšGòÖâŸò6‚HìÒò`ïƒ;áœÙJ±t–<sÍ­Èecº€)P>y\'¦(HFM‹vD×(ÚÒ·­}Œ¯å5dæø’4k{0àØ_ãE,\"\r¯ÎÑÓÐ\0ÂÀŠÄ¸–¬îÔáÕ¾\n~Çh¬­&ÈCÏ–r„\"¾î#Eù¨3,Ô¤åûd¤ñîC5ØðÙhó\n˜\Z95Â[}o¿|î7uÑµ›8‰$Üh©Ãq½Ðûµ¢^%¸ÖÆ$c«ÜŽC·¸‘˜g™á»1êÒ”gÈÊ95ÈC+â	‹:(ÀÕëItBP”Ô¶‡ÚÁÆ0—+KÆà™’œÑŽ=*ß¦BWæ—- §eÉ•’¦F]ª˜¹wz\\j›(Í‰ ¥åæêú¦´Á»è…8Š=ÄB¶÷ê²±…T9Q‘$R©ÛëpFƒ…¦•Qb5µÀú:É¸¤f	Õ©Ó“6a47~{~p[»1Êµö¿\Z?¢µUTD·gôÇ\0û69ÅTæ¸Ö~o[ã`ï¿tE‰v÷œÈtÆ3_jØE<ŠîûßÑ1”ÒKÔx<®¼9Þj½H*•–ÎÎÖ>ôta½È;4J¢ÐãÆÒ\\Ev\Z»R¯A˜Š•¤ÝáÈ,Ó,E=éÏæÞŒGÖáýk;5í¨DZxQTÏLÏH\n¹Ôéz¨eéA!ì\rLtÔºmÙ†þQÉÒÂ‰˜£Ð™µ…Ãpb­ÞCêû[f°Æ¨iŸùHa×dBZ3Ú44k€^4Ã¥¸ÈÓu°Äâ8YfÛ…Å†7ÔÌx³iDãÏlQÎ¹¡íŸ%¹Gº\\Q¢¢‡&ÍÎÙWvé~Z8à/Š+‹%éæè!á\'V5ã.¦ B!E¬\\[EƒüDär–DÓföÀw£ÛžiÝžµòàrßxù\r9<7©\rb&\rêœ„\"Þ£ƒZ¶º]“œ¨54Š¯nsªD§YÌ&ŸÐMy£;º½šÑEã	jk¼øv¬\nÞ,˜I3–.¶¥¥qº2\rà¸Óôçû›”¢ÉzC:†ªŒrî€”o\rtMIÿs™E»2Y^$¤UÿtcÑæt µŠ$‰@×ÐæŽrX¾†iH‰ÇV˜­_ãAJ—‘ì¯ÊâÜÔ\"V ÍfKÆ¾ ) j¨tÝµÒþÏ$ºþÿëÐÆomìšIýrtnW1,|µ$3Y–âä„ä+øƒf/›I˜)D…á0ÈˆÓó0 Œ¶Zïj\'/ãšOˆ°UŽ65”MÛx;Â¸g0tÊ›Û~4…ßWLM°£>Äºý¼¨À›,aGŽfQ\\ÔY…l!¿ènmÕÏ0/&€ï{ÒëFÒ´õšh¶8\'Ó‰“@ÙÒT\n:;7ÍDuwdÐYð¦â–/O©|\Z‚æváR–gßvJO=ŠÙhùã~o?Bh4\Z{„šŽ¨£ëHP4ÅÔJ68“AÙFÊb40u¡®`Úº×ó¥ƒï‘{ës;„ŒQRÔ‘Gvã)J;úÚ‰ÿh’Ah¸:kŒÆ¢>%Œ†äìýýîÆ \\+^cÝ‹™]–H´\nM‡NZÞkõaDµpƒQlÑ%<cz\"ŠŠï‹iôÒ ;žyÁHŒÑù\" /;è± „‘bò\'/¨ÓÞƒ:ÒÅý}\"\"ø¶¡³E¯Z;y;2FM——VT2ôÞD<ZP/‡Crtÿ	y2ö ¬¹ì=º¬ˆô!Äá;ËêGþ1Jñ›1W/¢×|“—;V4fÆJ­0ˆP—±Šº =æµÆœVTd”ës\"R\nuŒ~Ã\ZÍk£Ð¤î8dOTÊ‹ìhÉÞ&êäRÐA¨S„ÚÀXŠ¹(Œn%oFœ‚GÛ‰ò\'=oœßÚèÉ”;…ÆoÔ‰6ò„<ß”Â£ÃcÜÐtÂ¡È~H»¸&›’kÌÕÞ Ôòâ¼‰EÊÀ}N”àï6\"£?êéh÷±·{C©Ã¡83Ìiy{¼70ê©‘ÑvU3‰«Î\"c&Ðôì˜a¿q$›ÙH³¸väD2N³ã£=Ä~“m-ä,ö¦dEYA_À|ŒNM„ØR,¦‹.ðy‘u‚\r[}¯£©`04»]-‰æ­tç,B\npØ…Q\0\"ëƒo°Z½H)4°ÏŠ:[öÔ™LL\ZÐLbn\n´yF÷|pÇ†–ÕkK\rÈvíÍÔo¦2}@î}ß‡$™és]žþ\0Ä·³½+ñ¤©mŒ‚Š4SÒÐ3š={Ò/ÍnG7¦A ²î\rátÉTQ’A×:Ò73ÁfÐÌ/ë¯oDšèMä Ú2–©íPb\"H3Z\\+êôÇPWkI¤éèî_Û¼F¨F©“ª“è´XÑEê)&“¤+½I›³LQÆ¢Ë?6rUÊMê,ž—µõ[\n3ÆÎü‰FFÉ^âæ88=ðûºÑe¢Q)›Î­ôuË|%¢*¢Ñ…ÃÇå½ïÿˆ|ãÂ_ÊÜûŽB¯-hLÂlV›ˆ2¾lòØãQ\"`jbº\Zz#Ý/ÂHÏ&“*L1ër6rkõ–d*sè* Mö E–Ûf~Š,o›Á;²ÄcŒ%ÑÉ\niµÉ3ïÈxøû6£z(£\nC©˜hS/Ô¨´í¸¾g×1ã§¡þžUtiá~o$%†ÔµÙõ¢×¡åˆ6Ød)ºq<YÙ½&NFÛóþãÐµ÷#ÄV$F\"²+GòÿåÇ5Œ¸þ½` ŠÜøßšG#$R(”ä¾{ß/W^yQö çúQQµí@¯%E…¿höÚ€åºwÆçVivãÅ\\x?!:IFí1\"­¼^LF*;0û~Ðûxi°ßÔYÚ¨\Z8FŠc¨;æ¡L}ˆÆi%ˆjh¸Ï‡¹vÄm1ÒÑ+qK·§ê ìëGJYfÇÀ~*µÆy¡¡N´ÅV§LjÒ\\¨Fáß³ý¾t‘\"lî×ŽK™a9íqv%ïLpè\\ÇïI]r)™;oIÉY­fmG‡â8tÐóa ¡£¡ýÑ_ý4syáåW@ŽtòpLuq>§F˜nõ´.®ÔG€”\"7ê%ÓAÊ8AêN(xçêvSîD”Í8,+«WUZ ‡¢Á=±ÆÓ—VÄôšÂ­´Šex´è‰zA#yÛc¦WÄÙ4ƒ´°rÜÀÄ^‰:­OUÓµÕP±ë¶áÚQbjI_‘nÿ¶t8\0¿ˆ_ö†]‰ùˆ­ƒÅ( ”{2ènG°õ6RPš×ãÃÌaÆÒ‰†=Gˆ2nN`vý¾Ÿ–*93¤Ã¾?Gg€§–ä«öï¤\r„txfBÃ\\y61Es<I«“#ŽhmRWRÝÍQLÜž{Ó‰\rü`ÿÄÁYi/ïÊÆöžLÎ/êï¾kDãZ†kË”¢©Ê5©›5T1s¡2†º:M Ž©{`¢n\\\"P¢ÈÎ5½ÇÓš¼^¤ª°TTñŽå`gÌÆŠ™q¸±ê@TÅÞÌÍ ¯¥q£ À[{-0Â¶Î¦öH7€\"†¨àxÌ„%ã]Da4déÆhÝ\"\0ì 3v¡w[.ç:š3©e°˜†§–ñþB¢ŽÙùCR˜˜‘ƒ‹Çdmùº=8¡d$E&×vöåxŠ;ÖíÍ4\\\0ÛÄMèÎ`[Sêˆ£Ap¶™‰œEY˜Ÿ[\0’ÌÕÌJ£¶f6Òq³4²™iDr¡µ×°íˆa°tøÁLÅ‹ÙSb†^‰ »Ù½;&#³$NtÊív2r)Ý˜Äûß¸zSúÜãb3Zœ:–Ê¯Û1§˜Ì&¥Õvtš\"Hbõ%àÅAûèÞ9ãÄmË:DìG“|¦á6õ$THÚ®$–ÃëY	äÊ4PWäd[\Zõ6úž„6qœžç‚²ë>¸xT>þé_×áçr®(ºÿðgËxmè1p€TÒô0a„HTsá—C³O…Ð˜rhÌK¸3}Oê]e7+Ppôð¢ã×Ô÷B•}w6«ªÿÇBÇE }ÇxÎŠg«Í±\ZÁþ\"[‘î3ÖM”ŸÅõü75|Ý–c¸vRd0´tš3ƒPçq(7÷\"`duwg{§NmÙÔ3@`Žr3ÔBúÝ¡Žæp¯ÎÈðØê4ŠžMâ…‘Œ´ú¦®Œ\ZžÞH»³)É)PÅ”qÔ @_öÐW	Æ=vú.yÿû\0›…ƒÒZ½©´|<YB®ÝVÏíöýˆÒ0^©“äÑÞ\"¢-Î¨xC/ê²ÍV7ÃSÙŠœØ…‚˜Ì¹C·>ÔWW\0RâH“s2w°\0®®.ÝÚ¦‰üÇ6 0ƒ1Õímƒ®Ä\0`da0.ÄQSiØ P×À& wC5¯)\rÇpÛŸÃ1%[¡?S+{¢^§Wu“ÉT7p6Ô­aá›¦!Ì‹M’9›…Ô‹Ø¢Ü‘wH´ùÆ6OˆÊ½ë`G0TŠ\rßÞ˜ÂËås%¹û?¹KŽ‚‹Êæ’?|\n:KKQFfþ€ä®L…Ywú2ÚYA\Z\n\0y\r;çDt\\5Ø¨tëx…ó_T×¢ÃT”‚ãfOÀP0cÜÀ üÄÒ1ASo¯V¥gçÄCS¼··!ÝÖ†Ù¯h™æX\"êðUê&êãõD÷oú<U L­SžÊÖf›3\nC¶hRIÑóü¦W‚žÕÒ#ââi”¨Q–µA	¢sµIsÂÃBZ(Dš -xø!¦R4Á˜XCqÒê¦[ô%í®,LÎÈtqB-’Êä¼›]%&Kå¢juäOO²hâ\\n÷Ê-mV«RÍ‘M¤ÛT>‹½Z » \"£„Õ©ðÄé*‹ŠÀb&\rDê¢AXpÒ¬œDoÓ­ïÊåê\Z\ZÎ‚4WW¥îQZ†þä•AýJä¡ÔõÒá6¾DnNön^‘fkW3ãÃÍ$j\0m3¬tK`Ö b¸&…ß!?HÀDš‡GQñH/\r)4Î¨Áºr»D!—}ÉmµÚÕ‰d9òtÓCè´c´¡!ˆ”BÂá~ohtà!‰EO›3¦$lCy‰´‰bIf’{ÏÜ\'ó¸ályBbù¼Ô,è*±ôŽú‚®,9 ž¾·µ#“só²»¶)V&+…™EIŠ@>@\'µM~T¬h¨NŸpˆÝ¾E°à›ÑÖh2Ýó\rù^PÀÛ×/£wéIce¹ ¥ãwH{·!“KGeï\r_^¿|MÓ>g²”E­9(‡fg¥53+ ²ÍMyí;ÏIk{ÍÔÖˆhñ÷\'Þ¹†QaÕ 	9ÕÕç®k´t	\n“q#d©C;rky­êzýaU&\'–ÑX¦~¢ã“ÃZ[­¯ÃŽÜžSµŒ—Ž»Sþn*ž–{ïû°>uèY-à½šçg”Ö˜›Ažœ’›—oˆ…‹b³»[“Fk %,êüÑ£bÝÚD­Aiµ%=wZ:Í-3Žª’¶9†‰8‘I,¦)ÂÕôa¨F6UBN4&çOJij	Þž•öæ-q\'¦¥(Êµ¡¥ÔëM½qEGfÁ3K(øÈù6~\"Õ÷6eá®{$ŽÔš¾r¿€Ê¥oý|÷…o+˜±Ç;ÌX+G7qŸ4¾î#	¢\"OˆM=)×úÂáüóÍŒ\0˜†Kî¥ï¼rñ\0.Bs¿å(Z!¤¥tDþÊrL«O‚ãØ¥B\\3+KNÈÖ¡…@æg¦äÃŸþ‡ràÈiÖ!÷ÚžÔ××¥½¶\né´¡ƒt](‰êU¼nBwJQñÛÛ­K~¢¨0ùó`ãº´Œô×¶ÄÍ¦r¾¾Ùtª\'7¸éD\'qÛÓ®¡¼czŠœU˜”Òá÷Ih)#:DÏèÞCŠ²ÁqMÏÏCÜ2GÒQ&ËeÙ½vYZo|U÷‹ÈKxp¦+Û›;2—Êè‰wù¹Y)U\nò|D¾öoþDþâ_ÿ+åÆòé˜¦MNøSŒ‘·Íà¹©o2êfN)<}Âté^h(™å×7.¹/^¬?ô>UEZŒS\ZõÍÆGs÷q˜¨uO¸§“~|!d_£%ˆÒÐ;|è_’ø£îËÐ?†’X<Æ2+‰éEÉ:¨2l*GT€ ,çµ9â9V$ô¦f§ÄioIwk½PN–Žœ”­uI•g¥†ë®o^‘ÒÇ\0\ZíZy0u•%õo+ž\'?\'Ù™S\"÷ï òn¼ðÿ¡°Â³†±pIðXA»)î tuP\nÙ¼ì¬¯J†ÐtqI\rëíaAÓ\ZÝëÏ¿¦4zé03èBÇ¯Ii¡\"»×¯ÉÝˆæé‡ÏË¿}ö_!Õ4M›°ÎÒûû¨MŽ3ÖB\"Ú€@Ã7Óœ:sFžÌV/U«uEl(&º°ÓñFÃÕ\'@8²)Ó7ˆF~XÐÙó¼)o!|ƒ§.;-¿ò©_CÁDG~ø¤P%ÁjEßMÈ^·!1È­Ô¹H!ÐSžšõ ¿î5ÅßÞA­jIòÀ¼OÞ-Õu8¯áæK’.WdesSnmõä¾»HÐQ£%‘†P„‘ŽìtIÿøÑ¹Ø\ržüÚó215ãd¸»&±Ò$HFðGˆØîÖºø¦¦;wÅ½/éb×ž’…éIqÀ($Æ&NQŽo~é |´ûÆÆ†T’;NŸ•éÃ\'ä~ïwekkÓ°ÙX“Œí(çyó$»œEŠ¦*g<Bd™ÚK–\0€á%ÚB\r‚´q	œÕçˆ³Û4Ba$ÀØŽ™óÖá†˜²æ‚¾ÂÜÓwÜ+þ½_ž?è¹²µÛ”&R@ ’l[É¼-H±=È¸sÓâ€›¢ðE*lòøaÙé/#zJ’E„`õvuEn¾ñ†l\"Ïs0šCò`ˆ¸òÑ;¥=sL\n‡ND©Dú‰a¼±n¯ûµUÒžbM@XíjrùÆkråÊ\rIç+R8pDGIs³@~<§+™–8Äò+/Ëµ×®H\nhË\ZÜÈ¨àÚÒ0bsí¦,Ýu·ä,\0ª&t® Õh€‘ðåW?ûŸË?ÿŸ[/‚kD‚‘“ø>ëžoF‘èì)r„¶m4=1	¿õì¾ARÉÌ³£Qï)ý eu-¥¨\'Xº-T¹TtÈÙÓ´–j¶ÜÿàGdêèa¹öêüJ9q^›¼,5sP¦ñú€þ€~i ®)IŒºZtwÛ©u¸Y“D$¢¨¾£†üîÏËs_ÿeþÑçþ3ÉO-\0u¥5222÷¨7vÖ%71©r¦ï±#Á³µ¯­àc¶x÷{/Àè#\rùê_}U®-¯É:uþN\r1·lsË_?¾»¤7-^3.s‡Éëß½*æŽ3§¥­@¿ï\"òvVwÖ7å®÷Þ#‡ŽB$¾&µ½=¹ÿÜGåù¯ý•¢Æj#IÏXÒÓþ«i,ÔŠºƒW˜¤u-}zttk›–œ/ÿË/×ÿÎÇ>rp±¨|\nû èÊ 3ÒÓÞ,ðP<›Ä 9Ù\'Ð}\'î<#gïÿ¨Ô6‘sÓIð^q™F·]šœ¸?4ªˆÈÝ›ËJT–Q8øFêt=Ù\\¹…÷è©R··¶\"·ÖnQX–Ìä¬€fÔš~¯…¨©Ç‘3]Ú Íw/¿	`Bk\r#x,¾Y¸¹õïü…WWo®J˜HÉéû?(!\nô\n(\'U‚B#Á}Ô·‘¶\ZÛ\n÷¨5€	6”TgÊYÔÄM‹“\0*\'N•<œ¦\\ÊÉ‘»ïD½\08è²OŠ«#P“€ÐŽž8.ÿþ«®(PPÓò““`’êÐƒÑ@Æºg–Í™)¬Q¶:ƒê×_]ùü~„ð´ÿe/=’S0Â€{)QGâBV˜f:•ÞE¯\n\ZjÈâ±³Ú°%Ñ@e\n¨Ë7QÐ¯HÀú³µ¬S†™bY@HË¯KOƒ‚_XP¶x\0ä•Iã=zÛðš¦ö*,â‰ i½È¤„}cýªäps¡4g3J“·7¯+KçòZÏ¨Ý÷\Z›²»¹&[ß½$-4•<Šã›ßøš47V$¿p´	êLf\nŒòŒ2Å[W¿Ê¤”alÐŠKñè’ì^}YÒ£¦l^]‘\"\ZØ|\0sÐ…Î.ÌëY,gï»GfÐ4nnHqjZëÂäDEÞÿž÷É_ýõEÔ7Kw-søB\'t¢óYÈ|pHn$Ø&ÅÄ”æ…ÇvØ7ÈÖææ³•éÊ#<¤…!ç÷-ž^Oà‚!ŸöÚ\nyD= XžBÎ]Ò°œš*£Áá½Cx`\"™•ÔAô ãÔ”d‹ÛâMTœ€Ç€-NÄ‘î1U)&MLM\n÷æt¡½·›èPèw×·\rG†ÆpÔ¢µ	Ê±õš¼ã‰MLÉ:èâÂ	u¼ W_“›Íž|ç{W¥ÆàÎ;ïDŽ¯ƒH/Ö\0ÒAjiH¾P(Èääœäg‰ˆÐêk—¡Ñ7¤ßX—X&\rÇ˜Bop\nã4 î¼8@WÍõ-YûÞ+²òÒ«r÷ï×c£²pF.ôÖå×díÚyàïüGò×Ï}ŽjTÂÝÍfC	[Þùœ¤dÍÓ!ð€ˆþðò»O<}ñé?xê’òYóBs m0´Ýµ\ràf³xæH×˜œ¹ïýðÚ	ÙÛiÊúå+RN€&@gÞ\0ûŠ†ZÈá]ô\nzRðfÂ¼Vº¶Ã÷@6Ö8™’•Q‡¹\r_ÖÕ\rþŒNjç	t=Ø’ÇÅno5ä{ß}Î[JJ]o&?!/íÒ¦+k›\r±‘šT¦š2`ƒ{bg¹—Š!ÄVKY®\'híH­k)3¼³±+å‰¼$Q¯È[Ñ‘rKrf^¦‘îÆMÉ%ò’K<Æ6@÷Ý^~ÃˆLHy(€RBgŸBTO¢»¿qkMØ4C!FËá¬›NÐ{A´ÅAç«¯¬ìü`„ðQßn|yr¶r60‡éjJ®E2IÉÇ3†¼\"ÅÜzdiI;Íéé’\\~µ›TºzôŠuØo)²ŠåëÒÞÙµß.G¿€›œ¢qcžuàõSH	¼6O\nt\0M÷Ð?dòaÃZ(¥ˆ\Z²~ g(OÍÈ6ê\rGâàßGˆœ›[+P\'“2ø]YìÉÆ­U™G-+W&d´·8œ7UÔ\Z8\ZöeÖG¤wvÐáƒgëÀ{¹c¬žíê7Å\0ð[(Ül\Z‰ÖZ¬oÉò¿¥ésöØQ ÀÒ¸vdiJfî¾O†¨\'ÝH	Gds{Km×1‡¡‘oãkiy€XeÁ ý2…Ü“o¶Á÷¤0Wx:sáAd)ÉË„#ˆVðX9”p„š™Yé‰Ý\r)°{]YÛ‘B)ÔþK‘ªæÎYûÒì¤¤aànÄBj+%EJ€Žžm¤Øùƒóàû#¦,t‹fwÑŸ4÷$ WÀ¸<-ÏJ¹“a« [ÂÙVM\"É«,I\ZšN09ÆqMp\"¸«D®¬0ÓFÎãû•‰<E7É{^DoTSoÍ£¡ßÝ\Z¢È×Õ 	ôN5 ¿›W«\0%©^»%w¿÷.\\—­Óq¦´ƒ3âdò²ùú«š†ŽŸ:-ßùÎ7uN¬Ã3_PCT‹¶‰sìŠ\'<a%“™‹?Ô =üXýŸÿ‹ÿíÑc>FR)%LP“»`IYÄ†§î¿_€ŽÁæ¶ŒÖWdvöˆBÄ]ÀÁÇŽ\0%áÑõk»’ŸÕ‚¡ŒÂý\"q¤¤t0€w%·ÄýU-0»ÝÚŠïšoÐêÊÎUp];2(—dØ®ëM$Ae4Pì7ª·ÄŸô-ÊñûïÖ-	ßü‹çdÛsdûÖ²žËØ ªÃÀƒÅÐ‰“mÝ¾q]²H9»Ð>¬ÐœÕº÷¹2/%¤-/×‘§ö0”;ï½[ÍUPŸv³²qó&TÆ†¼øõo©Ü}Ï	è®%]PöMDö¡“Gå#÷ò§ÿæKzPç¸S˜#ºÜˆÄ”Í‘$d\naÏüÛ¯¾Xý¡áãùo¿üÌ½ï¹óŠÿÜÍÊCíù¡)<mš+‰‚=UYy³tæ=2@³®]—2x¨½®m\ZHšÅ«ï¡[Gµ²¬»kuoô!]€ƒD¡ à)šñ‘\nRó‡%^ž–44uŽúô\'¯Èòñôì´ôáÁ!jA¢<#ÉméºP”§çæ&Ay€Ê>ñK’õ=ËÜ´í¤”a—ulW Õ[¨­TARÎ\"ºz›h8‘>»»[€íRß\0ÇÖâª ÛÇ÷+`€ÓÜ	ÀÏ²Â§…ÔÌé™²òfß†Aîº÷ŒÞ\'ÏQÙ¼~CæÃ{%=LÊ4²Á?fÃ2‡$ðàn© üKç!pÙiÿÉ¿½þ?`ß{ú÷.ýîÿò;ÀmÖ9jÙ=°®ýzG?bqš8µˆ\0Ž†È˜üMÌÌI®$¸tY&“þîž\0Øu±ÔßÙ©¦ð¼$úú‰TeRÊKH™UüØ£ƒùeˆS\r¤.Îq¤aÏìäq\\?sèe<BôçgÁÆnoíÁ³Sh<3â¡VÑyÚœhÌô;É>—Ó”ÜÅ¶GÔ‘ød·Ÿ.•$,ƒN/£ñ[\0;zÑ¬^F„¾.[²&(þ+Y@dôRðîï¹÷žt^Ým¹j›“­ùÁÂcC ·Ê¦§‘7%ÄÆF8›ÍÈn­®×Ã´zþ3_¿x¹úc\rÂG»Õ}8™ˆß`ñ¡uyˆ™ë™óïEº* &ÔP¤û×«ðš‚ŒàáÉƒGLDJ‚8¤Ø»Û@)¥ß¬)‡“B‘¥GÇxN;n¢GmÆfZì6`È½]‰í‘uä<®U«Iöq!\"Ï-Ô¥Óª[†°T,h$u¶6$GBtyyCVÐÚ±¤Ù÷‡ÚãƒwŠo7ô½6ÐˆvÛ\rÝÚà[X,ðL@bÜmÅ½•©(œ|Z?úBÏqôâ2yênI¢INl·”é¾ùÒ%‰OÏ#ãäÖµeôl]¹÷ûÄ[¯Êò7¿!Gârˆ®{>òQùæå?\0Pªé6\nOOAõÌ.2Â}ùÁèø¡yâóOTç¿ó4\\ð€aÜÈ³Ì‡‡ÀÜ\"tIdp—c>N&¥„_b\"%íí\r) /éÁ˜<šÃç<.äÙ\"Œ;¢ê`p¹g$(ºví¦N—‡ôøþ@?˜ÅÖúhü¤^mq°Îs ->{%ˆrUá´eŒ„#‡ûÈ·Å£Ô#T¹óu}Ý[ß¥±ƒ¨²ÉèÆöÐ—Ôµöqû7¼7Ôˆ$j\rG9*„T“CÏUA÷Þ¸yC^úÚ7žN\0¤”¥\ZŸh®Ñ®ÉäÙ{$cXèkOœVÆcÈ£¬<W7Cüh–Ívžyî…kÕ·l>Ön¬=‘-Æ?‡)šm–Lã\"=è}4ŠšSÑ©¶±P7@S€ÕsbžuÍ†±ïM”»`¾[à\\)è9XP6‘w¤<VPyúÐ‚†û¨UCG}bUK·ÅM£p³3Õ·u‹„[šÂâíè´Ha¢,Kà‘\Zëi=³¤\0V—[ÕB›ýKLŽž>Ž\Z1Ðú“™šÕsä—yhˆÄ\nžK6š|½…¨±z]åî¶aœº}ªâVÆM‚HuÑŸ$ÑT¦§!PÝÚKq©»+I ÃšMd|ßL·P¿³ \\·ñõQ[:õè/Up€Oþ°uÿ¡yúé§ëþ·ÿÕ“èµžbú!5áke\nÒ7•Bó3ƒ$ \n7vt˜lûÖ-IFG2‘ëçN\\¢2BÍ<ÐÕÂÒ 2¨0«Y@ÏP\r©5ðl^îg§æç@<ÙáÖfÀT¿ø‹ö<s<¬\Z\"§Ý²ÂÚuî´UÉ\rè[„)Ö,\0ÏdäÑCnàÇðÁ{s’]¢ÔtQòh óèav·÷´?aã¶zÙ’Üq­Z˜0G ó4¢£‡èHQõ¦ú­oH¼½#Swœ•êë`’³	)æþ\0@&\'+rkÅZå…æÌS Ý\'_øçÁÿÈSIŸþÝÿõéúOÿÓO%mçˆ,Ýy¯ÄA}û æH‹ÇQÈü9¤Ÿ‰©ŠßŽ¬\\~CîûåIù½»‰b;{\0¶òíðD7=³*àG¡¸­î@JW‹èC@[ ïhÞša\r“ZõºÄvgÄƒ6Ï&“hÆÍMè©¦+×Å†aÝºŽe7ÎéÎÊª´·jÐª¡ƒ	† H[uIÝ¬ê9]Íeü^NÔÜ×ïJÎ? iÊ\rèyâÜ´ÄÔ¢N!ˆ}äe$ã\"?¾î‚‹Óó¾Ð¥ï]yŽÑ49#zn]»´.å™#ÐGæáˆE9qú”|ýùÌ\\—è9ø_øÆKÏü¨5ÿ±çö¶Û­‡+x±˜Í-;%Û JÒXXÊ[ýêÙ­÷‘–¦ kNhGêaá­06<6àgn ÷àY­•RÄ\"ÕWoâ]SÒËå N!% ·ˆƒ¦pÂ	Éç$}`Qb¨95Ðy€3€¶}ô\0<„€S€”’‘z¦*øù4$—\Zê	P%X@òa¾©RpéàôŽ¦ÁTeVwó¼d	©éN@Û4@·»ˆ¢Ú` ­g„Æ c\0ƒ“³‡”©p(_£Žæ+e¨‹PW·•ŠŸ¹ã„ÌÜõ€äPo¸±trC¯]ÂóXk¤À£ÐZ¬èSá€[ê™Dêá·Þ?Ö Ï<ólõüüËOž<~×Sm,òÖÖ-™,&¡ -‚¶èJõ9q€4z%À;¨N`l»+k¸hÌ:,@DÅ¹¤8h<\np\Zü˜ºé‚âDÊÜ¢\0Ïm¡/‘8X$¢’èÇ£þÌ9(uÂ®—ü¢Ò•¢Á\"!:ÔMöIxf jŸ›J«æ/AV¡¯›+I\nŒl©vX‹KÐôøñ£LNËt’ü4¨ÑF\ri._-rKn­´&ÙOàn£†ÕåôûNËäÒaÐEpB8Õz¢âÄhø¶ÊÃÝõ]\0_¦Y„¤ˆè\r¼\'/þûª?±AÔ(ÿê«Oÿ7¿õ?,¦\'§i¯ðÓÒ\ZRktu(yø˜ä§;€”mPrgõe”/‹Å/{à°Œ}È¬.¢Áâ)Ö@OÜdÃíü˜	¹ ‰kÁû@Ô&T¸5tã-H¬,²4˜rÈnÖdr/á&§‡X\0|ŽþkS:øŠ|§CÈÛÒS¯{E};kë:0­{qq{(ˆ\'» >Èê²»çî•…gm¦b¯ÅÍB»P\r§—,˜ˆM%2wnUåÔÒHUôL©†\0§N@ž–¤ÇšM\'°¾ðÂó/?ýVÖú- ËÕÕúï=tâ#`6Î¶6{²ÎvssW*ˆŒ™;OúfÌQâ KòDO„¡Í¤.ÇG;¨ëÐÊÛH.Š¹zùšîŒâ±ådeGX@ÎÀö\0h\n;H3ñ4¿æÀ ù@[SÏ\'ôåÎÞø\\\r89‚;áæ ¢8²Ñü®‡ß³\0zv2+‡b³ 7Ú@Ë÷ÙY_ÓÖˆ¤IpŽ€rNÒ\\xy\ZÅ¹€¯w¹ù¼‰´}ó{/‰+Êl!)Ë/|ÜÜ\"$êY¤º9HÓú1¯dÇ‹Åbõÿú£/½¥ƒøß–A>ýéOÃ¡kŸövW.àF\'VäFuU^³:f•g¼çŸV½vcmWš¸Á‹¬·b”?° Ül3ŸsÌ)Ä$ŒV@ƒGtC¯Ñç¡˜@=<ð’$\\‘6;g¨é‡ÚEïGÂnbfVæægÅk¤uºÒKA=Lº\nŠ¨ge¤!Ÿh·0…t(î|rzFŠÈõuG¤i#\"è4{¨!!à{\0MÇG­‹åk²½]—½mÈÑ<Ìpz¯Ö–3ÒZ	ÊÁÓg¤ôØÛ\\—©Óg5âHã­½ÙZÛ0(UÿîÇ>ö òV—ùí}äQ©Tª~ñ·Ÿzp4ì¾XÎÜ_<|ò°\\þ^(ËWo¢ˆwdºç˜v6øQ§<õÇž‘}o#—OÎ@v@Ï€…í@ÇíñS×`¬™ù	ñp“<H9Y*èÐ‡’sh8Ð´ã$â8Æ×áô=y¶|\\\ZÈÅ‘54“Š0H¯ž×\\_†‘¹rHêFŠá59jÃÍ¬\\Ü)ÔŽ¬hj;yç	¹öÊ«JZÎ.-BJ^—=\0S@:ãÙ’ŒümÀàu8Ã1ÜseHlÑ…Ôjç&¥ÙJÙ@W^Ù:	õ´U¯×;ùà¯?üOªogßögP=üùÇªO=ñÄƒ½Qp!ò‹$àl<ZWVÀýô(\'÷/˜—&š˜ô†pÿîÚšLÐÓ8xéƒzñ‘vü8\ZH,Â°±+ímMiáéU—‘–¶%¶s^ßÚñe°¹…Ü\rVÊ\\;\0í2DŠ$üegŸÊJ¿ßAAíŽ¢±n}Kû¡KQØctÅÐòÜ6ƒÂôÔQcå@íó`þV¤¶×CSç€‚i¡¢ÐÄÔß…€¶Žj€(H!\"zˆÞµjUF [=èì“SE™XZªïu_|ðÔ=÷Tåm>ÞÑç>öÄ—^}õÕ7¯]¹Ð»ñZq(Ksge¤ãÞú†zrûëxw!\'²:Ëà—\0‹‡Á5m¨# ^B{Ý¤ä‘~=v‚§Êé°7x~BÏFAHý¼ÖÂÏSºW‹s³1DOsxv?¯\0!Žq¹Å¢7\'j“X™€æ:Û›Ò\\«â÷ââ5vÀøf\0›kHiüÈ%²\ri ²l†ä<\"\ZJ?É00‡ªu!´ÝyîœÒöW¯Ü’\'\Z`r 	\nõx¡òà=üä;ú,ÃwüÁ’wÜqÇ¥?ý¿ÿÅƒ™ù…}?,r_HeùŸº;roÊa½ŒåËwÊ­„ù\\‘Š^\"Þ%–Ñ´S9uTy[l ¨$¨	¬Š¤F$#Ñk,¯µ<©uÁ…|\ZßëIþèQÒplMÕÞû#4uÀKéÈIöÝ×jqöÛ’Aßœ\0EŽtè WIæKR*¢žÝpµó°Oâ t‘XMÃZf#u…ñ”¤°ðõ•P/“ª£sèáÀ±%™Ê8rð¹×j×·Vn>89yà°äOôIŸŸüÿðÒ}é+÷¤r¹Ínc1´êÒÚÙ“‰tÂìÇF/š@³m`X,Kziº4 ª|ÞÂÛÛzž/GLÉÜ\"í¢›Ï‚ÿ…ÂÝA]ÙEd9<¢llì/?¹™=AMY:céY}·¥þt\nt*ëk!÷|Ô—xW5}îØ%}íëp9Ø\\¤9hÅbO€:0‡\ZW‘?Nƒ y¹æ½ªµmgi.ß\nvT	¹{¶z\ZÐÌ4ôž°í£U+Óù\'g>X•Ÿàñî¯úÕ¯|ãÅoÞ¬^h-Wk+b^’ƒ÷€úWQÀÐãî+‹áÂ¥ÏÚZYAãµ‰ÅÜÚØÓ¦jPÛ–ÔTO?Iaoi$íŽzÐ/ Ç&j²zsMU»4ˆÌ¨\n—£1ÔF~6\0«à¤bnB§ZÚ;›X|D(ØÝ=hÜ¤ó}Ý¦³vvQ·—•>êIš\nƒºÕ\"ÙØ•ø<ˆÐ,Ä4¼61é¢¶KUDwo,‹ Gj÷ê—–_|áÓŸø\'Uå\'|¼+Ÿý‰ûµx-ý³ÿþÉ§\'}„ln“Ó*ðÖ­µš~Fí<lou]>è—6¼ êµœøàxIDžz=à(‡òÚ8ÍžÊc¡|KkÁ©ŸgË1Ïx&!	n„iöAøA•$z>•Ë@{Oëö‚!š?Ž¬ºI¼÷ClX1nItpm…ònJž£ª+[Š°Êó€áˆœm°½èôP=]<§ß©ÉÉ3wÊ4JÜë_ÿ/Ô˜`âË+O<2VÞ…Ç»ú÷ý7ÿÝ]gî…û\0¨‚d]6…!6HlÌ8Á’à‘³¤€n:@\\Y °?E›„Ž2â¸Žor#ÎÒÈ‘‡¥œƒ\nþ)êÅÌÇZrréAô/_%paetÙœæ`ôñ;ƒ¶ŸÓ}}<ºij~N?Á\'™MËahþ“€½i¿<3£Cå)Hsfôl° ,Ï‚çÆžuˆ]l6w‘†×ªÐÒÑ‰™Ÿ‘‰|ŒL±~}{÷óÿÝO>qñ¹çúò.=Þµ¸?~çügO?õÔï?[¬d¾è§ìs:N¡€–‹q°¹Mý `rS¤$846ø LË¢¦_•\0:Öº<€KQK6hâÌV¯ÛÕ¼.üP~F\"¾r?¢Èç‡R¢Éò þ+ÝîG‡üaQB á¹=;Dt¥€ð˜ÚÒÐGÞû¾3:’z-e£KŸônêvÐïdñÞ¨QÐò+`·-DÉÔ{Ž_<øž{þìÃÿ¸*ïòã]7=¦ÍÐƒÿúO¿r¾X*=^œÈ/–&rÊÕ\0[ýtI‡F£[z f€Eî‚¾Ñ¬m¢cA‡ú0€ŽßY²B}á6m+!µÕ\r ¶UÙuÁqnl¯‘+D°I™tÉvˆèƒa÷ÀmBƒˆš\Zêçp7@å\'‡x½i” «Ï J	4’…¥+`\"\"rTÁ´0Ï“õr.ýä©»?ð–x©wòø©düøÕO~â™¯\\¸p1ÙM<ýœ‹üÎ}ê$÷|¤«ö5h\nË®òiÝ{—@nOV—96Å>=-•¥:Øç~uü‰X0íIM0¾ƒ½M%] MvÿH[…cÇôñ!êÊ`¤£2’à7‘zçvµ}<õM6B¹¶õs®j€Þ354¯D[@}}¤KNM¦RÉ/\\~õå\'ðxWjÅ{üT\rÂÇ\'|°Š¿Îß¸qã‰[—/?Qý•Ïy6©…ˆE”0HªE°£Ü=s[œ?€BìËîëW‚&Aq{\nŒ“ ÷ÁÃr?ëJÏ€’É(”¥¦ÂNÝ2bt¸É‡Çýñ šQtÜ64mN¦”––tŽ+]™”ÜêÌÆšš)É=gï‚l}MâW¯‚üµ¥výŠ4–ß€wó¢†þé§«ò3xüÔ\r2~,--Uñ×ùßÿ­ßz\"q0÷DéÌ™ÏuÁqÜÇCNçæd„­\\SOm!’BŽZÂ»Ð*Ý .MÀå[ëzº\\ˆ3ÃCÐ%> 4Ïf©íì ©ÉÊ²&Ñ¤r–PÛCÃÈÙÝQbT±¡Ûí”ŠÁ{“Xä”Š‹ŽŸºIyé(œ`ªž:ÔüÃ¯^zå™ÿãê7yïäaÉÏéñÅ/}eô÷¹íÕ­Ç¡½/òé¤7\\¹¢Çº®ÞZCÏËÁƒÐV\0O;¨5@âåêšnË>}×i=ZƒTLÀ.F©^_–6ˆÍcÇ•”ìC-äy„«WªJoLƒ=Iz¢ALá½Úšís\nÈ¬[«]\Z{_>~úôÓ÷ÜsÏO55ý°ÇÏÍ o~üÚg~ãÜâ‘Ãçs1ë#•Ùih¸I@ÎH¢e9th^Z«º…¬ŽÈXƒ¡8åzìÔIÐ`d7VÄ“8À®¼öºžÍrôä¢”`68«ú$.¹‰×+¡~”ÀKyš zãGûmnTg&Ë_.•òÏ>öØ}Q~ÎŸYÊúQÿçÿÏ‹ø‹äKþçg¡Ÿ\rFSŸš˜š:{ðÈÅm{\ZJ\nq—‡à¿Ùƒó€°1ná‘xi\n²oB6Ö7càš¦d\ZÚv7Óéy¢\"ÙÄ£ù¹™*ô•‹Ý—v‡­gÿà÷ÿ§ªü=~!òæÇ§?ö1ælþy†ÿ~ôÑG‹gÎœ9xt6p­ÅæÞîîwµÛ‹£¾S6šÅÀŠ›P#ƒv·ÞÞ,3wë	[ª£Q°ÜzÕN­Vý³ï~óâÅgŸý¹¤¢·úøÿñ¨…oOÈ\0\0\0\0IEND®B`‚','Kec. Test','Kab. Test','Neg. Test','Agama','L','A','Test','2012-12-12','Kawin','5555','',2012,'Test','Bd. Test','R. Test','2022-12-21 22:34:04'),
(2,1,'admin2','test@gmail.com','$2y$10$muK9xltRI5MxRJwcfozGjepKNMElNZLoArpDumW9tjyv3NeAyEdUy','1','Test','081','Jl. Test',NULL,'Kec. Test','Kab. Test','Neg. Test','Agama','L','A','Test','2012-12-12','Kawin','5555','',2012,'Test','Bd. Test','R. Test','2022-12-21 22:34:04');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
