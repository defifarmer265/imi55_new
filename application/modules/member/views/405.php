<style type="text/css">
  html, body {
  background-color: #2d2d2d;
  margin: 0;
  height: 100%;
}

.container {
  position: relative;
  background-repeat: no-repeat;
    background-size: 100% 100%;
  height: 100%;
  background-image: url('<?php  echo $this->config->item('tem_frontend_img'); ?>bgm.jpg');
  /*background-color: ##2d2d2d;
  background: radial-gradient(ellipse at center, #1b2735 0%, #090a0f 100%);*/
  overflow: hidden;
  text-align: center;
}

.epic-story {
  font-family: 'Josefin Sans', arial, sans-serif;
  font-size: 36px;
  font-weight: 400;
  color: #f0f0f0;
  text-transform: uppercase;
  position: relative;
  z-index: 5;
}

.planet {
  width: 180px;
  height: 180px;
  background-color: #c75314;
  border-radius: 50%;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
}

.crater {
  background-color: #9e4b1e;
  border-radius: 50%;
  position: absolute;
}

.c1 {width: 22px;height: 30px;top: 60px;left: 20px;}
.c2 {width: 32px;height: 40px;top: 30px;left: 60px;}
.c3 {width: 25px;height: 38px;bottom: 30px;right: 60px;}
.c4 {width: 18px;height: 12px;bottom: 30px;right: 120px;}
.c5 {width: 34px;height: 25px;top: 70px;right: 30px;}
.c6 {width: 21px;height: 18px;top: 30px;right: 40px;}
.c7 {width: 25px;height: 38px;top: 90px;left: 60px;}

#hug {
  display: none;
}

#hug:checked ~ .no-hug {
  top: 0;
}

.no-hug {
  position: relative;
  top: -999px;
  transition: all 500ms ease-in-out;
}

.no-hug h2 {
  color: white;
}

.hug-button {
  font-family: 'Josefin Sans', arial, sans-serif;
  font-size: 18px;
  color: white;
  border: 1px solid white;
  padding: 12px 24px;
  border-radius: 12px;
  position: absolute;
  bottom: 5px;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
}

.hug-button:hover {
  cursor: pointer;
}

/* -- stars animations -- */

#stars {
  width: 1px;
  height: 1px;
  background: transparent;
  box-shadow: 1069px 1980px #FFF , 1553px 1152px #FFF , 508px 752px #FFF , 1088px 734px #FFF , 1449px 140px #FFF , 1833px 1041px #FFF , 417px 1965px #FFF , 969px 933px #FFF , 1767px 1694px #FFF , 1282px 184px #FFF , 850px 1675px #FFF , 1692px 415px #FFF , 1732px 941px #FFF , 1378px 709px #FFF , 1438px 536px #FFF , 742px 1380px #FFF , 873px 1511px #FFF , 907px 991px #FFF , 1839px 1661px #FFF , 1688px 771px #FFF , 994px 1086px #FFF , 913px 1619px #FFF , 1011px 1106px #FFF , 1325px 1724px #FFF , 1994px 1267px #FFF , 936px 1272px #FFF , 1997px 1933px #FFF , 1180px 6px #FFF , 1735px 1997px #FFF , 1357px 1337px #FFF , 1927px 1519px #FFF , 606px 1817px #FFF , 1782px 706px #FFF , 280px 1980px #FFF , 237px 380px #FFF , 702px 1936px #FFF , 564px 508px #FFF , 1192px 619px #FFF , 828px 1802px #FFF , 1750px 1751px #FFF , 171px 1251px #FFF , 499px 827px #FFF , 1192px 703px #FFF , 810px 1226px #FFF , 713px 551px #FFF , 954px 819px #FFF , 868px 520px #FFF , 1579px 1325px #FFF , 411px 341px #FFF , 212px 116px #FFF , 811px 1333px #FFF , 650px 1239px #FFF , 78px 1693px #FFF , 1298px 434px #FFF , 1369px 1530px #FFF , 749px 1974px #FFF , 57px 894px #FFF , 1814px 651px #FFF , 436px 837px #FFF , 402px 1006px #FFF , 84px 1426px #FFF , 1618px 1585px #FFF , 1464px 1841px #FFF , 693px 318px #FFF , 962px 1618px #FFF , 141px 910px #FFF , 545px 1633px #FFF , 84px 1683px #FFF , 1170px 1710px #FFF , 1544px 1169px #FFF , 987px 857px #FFF , 372px 1588px #FFF , 318px 12px #FFF , 294px 1103px #FFF , 1537px 879px #FFF , 456px 949px #FFF , 566px 1960px #FFF , 1015px 785px #FFF , 23px 1088px #FFF , 625px 1295px #FFF , 149px 171px #FFF , 1153px 1188px #FFF , 1636px 229px #FFF , 1954px 72px #FFF , 1779px 1650px #FFF , 791px 1049px #FFF , 810px 451px #FFF , 1969px 663px #FFF , 591px 526px #FFF , 641px 968px #FFF , 1232px 471px #FFF , 353px 383px #FFF , 362px 1131px #FFF , 1237px 596px #FFF , 1544px 916px #FFF , 144px 1233px #FFF , 365px 1143px #FFF , 1768px 961px #FFF , 1907px 1925px #FFF , 791px 1068px #FFF , 1943px 943px #FFF , 1926px 1603px #FFF , 295px 1088px #FFF , 352px 628px #FFF , 94px 1730px #FFF , 235px 989px #FFF , 63px 841px #FFF , 1763px 36px #FFF , 1078px 736px #FFF , 1636px 1204px #FFF , 1733px 1708px #FFF , 375px 476px #FFF , 1517px 1633px #FFF , 1864px 83px #FFF , 1734px 408px #FFF , 92px 1157px #FFF , 1183px 1955px #FFF , 1089px 514px #FFF , 155px 1734px #FFF , 1184px 1304px #FFF , 908px 1441px #FFF , 1436px 588px #FFF , 635px 404px #FFF , 1322px 366px #FFF , 262px 585px #FFF , 1913px 1719px #FFF , 929px 1449px #FFF , 1223px 856px #FFF , 1870px 1351px #FFF , 208px 1694px #FFF , 668px 1743px #FFF , 218px 1201px #FFF , 749px 1453px #FFF , 890px 1535px #FFF , 1147px 1089px #FFF , 402px 43px #FFF , 146px 878px #FFF , 682px 1183px #FFF , 777px 293px #FFF , 349px 398px #FFF , 1082px 1954px #FFF , 1721px 1122px #FFF , 942px 1538px #FFF , 1549px 184px #FFF , 1705px 1070px #FFF , 1461px 1379px #FFF , 690px 1883px #FFF , 1506px 1622px #FFF , 85px 282px #FFF , 912px 1227px #FFF , 1275px 34px #FFF , 647px 1257px #FFF , 609px 1900px #FFF , 88px 1825px #FFF , 38px 850px #FFF , 749px 1934px #FFF , 110px 850px #FFF , 1883px 524px #FFF , 1871px 1990px #FFF , 874px 1999px #FFF , 6px 783px #FFF , 571px 1763px #FFF , 306px 928px #FFF , 1637px 1276px #FFF , 86px 781px #FFF , 1467px 976px #FFF , 1873px 109px #FFF , 1908px 1918px #FFF , 1441px 1707px #FFF , 1858px 345px #FFF , 404px 271px #FFF , 921px 275px #FFF , 1017px 1287px #FFF , 1904px 130px #FFF , 510px 32px #FFF , 1577px 1142px #FFF , 92px 119px #FFF , 1523px 1012px #FFF , 1638px 1757px #FFF , 458px 330px #FFF , 804px 1722px #FFF , 1044px 815px #FFF , 79px 1054px #FFF , 1202px 1961px #FFF , 1515px 986px #FFF , 721px 1462px #FFF , 1803px 302px #FFF , 718px 952px #FFF , 1729px 335px #FFF , 458px 398px #FFF , 1913px 1582px #FFF , 401px 831px #FFF , 864px 1433px #FFF , 823px 1848px #FFF , 597px 481px #FFF , 338px 128px #FFF , 1337px 428px #FFF , 1542px 1605px #FFF , 1696px 488px #FFF , 982px 1838px #FFF , 1249px 100px #FFF , 1246px 1381px #FFF , 993px 1826px #FFF , 409px 993px #FFF , 2000px 1241px #FFF , 432px 585px #FFF , 367px 416px #FFF , 1553px 304px #FFF , 1774px 1021px #FFF , 1298px 1235px #FFF , 1252px 677px #FFF , 1054px 1024px #FFF , 584px 1754px #FFF , 160px 735px #FFF , 1111px 1822px #FFF , 985px 1642px #FFF , 1869px 862px #FFF , 1384px 1165px #FFF , 469px 762px #FFF , 526px 375px #FFF , 1077px 1887px #FFF , 38px 1495px #FFF , 787px 1875px #FFF , 343px 141px #FFF , 1928px 1119px #FFF , 437px 1806px #FFF , 1950px 487px #FFF , 738px 1353px #FFF , 284px 1176px #FFF , 1034px 1954px #FFF , 383px 674px #FFF , 1836px 1030px #FFF , 128px 1593px #FFF , 923px 148px #FFF , 1176px 6px #FFF , 1607px 304px #FFF , 1066px 4px #FFF , 1735px 1020px #FFF , 1528px 799px #FFF , 628px 1836px #FFF , 835px 856px #FFF , 67px 1007px #FFF , 1333px 1845px #FFF , 207px 1502px #FFF , 1229px 1796px #FFF , 458px 823px #FFF , 1942px 75px #FFF , 919px 895px #FFF , 1723px 1897px #FFF , 214px 1496px #FFF , 423px 1809px #FFF , 1573px 1294px #FFF , 1106px 215px #FFF , 372px 305px #FFF , 1864px 198px #FFF , 1347px 1320px #FFF , 200px 1836px #FFF , 1025px 1208px #FFF , 1519px 910px #FFF , 1943px 506px #FFF , 728px 434px #FFF , 1893px 1602px #FFF , 498px 214px #FFF , 1138px 1342px #FFF , 871px 302px #FFF , 1397px 1767px #FFF , 295px 1433px #FFF , 280px 54px #FFF , 1364px 235px #FFF , 804px 1003px #FFF , 1183px 9px #FFF , 480px 207px #FFF , 510px 234px #FFF , 1282px 1818px #FFF , 233px 1713px #FFF , 1195px 1366px #FFF , 1776px 411px #FFF , 1486px 414px #FFF , 1644px 1814px #FFF , 1610px 515px #FFF , 876px 429px #FFF , 1895px 1020px #FFF , 1449px 856px #FFF , 1314px 818px #FFF , 930px 1329px #FFF , 1335px 1863px #FFF , 114px 58px #FFF , 1403px 665px #FFF , 78px 1026px #FFF , 1253px 1932px #FFF , 619px 817px #FFF , 1873px 908px #FFF , 617px 1817px #FFF , 1294px 444px #FFF , 286px 1684px #FFF , 135px 1000px #FFF , 1569px 1308px #FFF , 835px 1645px #FFF , 1642px 1975px #FFF , 1093px 1392px #FFF , 1994px 23px #FFF , 733px 1302px #FFF , 305px 1417px #FFF , 709px 708px #FFF , 872px 1878px #FFF , 1972px 1086px #FFF , 1428px 1839px #FFF , 1132px 68px #FFF , 870px 159px #FFF , 1603px 358px #FFF , 720px 41px #FFF , 1325px 975px #FFF , 1674px 1832px #FFF , 231px 876px #FFF , 1573px 1881px #FFF , 40px 1671px #FFF , 1025px 1642px #FFF , 314px 740px #FFF , 1262px 970px #FFF , 1967px 1139px #FFF , 1987px 1184px #FFF , 376px 1872px #FFF , 1176px 1535px #FFF , 467px 303px #FFF , 324px 745px #FFF , 1253px 1261px #FFF , 1048px 575px #FFF , 608px 414px #FFF , 549px 661px #FFF , 536px 897px #FFF , 1917px 884px #FFF , 796px 143px #FFF , 1972px 854px #FFF , 1172px 369px #FFF , 1233px 1243px #FFF , 1714px 1574px #FFF , 379px 213px #FFF , 388px 1111px #FFF , 848px 496px #FFF , 882px 573px #FFF , 764px 830px #FFF , 365px 1066px #FFF , 626px 822px #FFF , 688px 1981px #FFF , 1682px 990px #FFF , 889px 809px #FFF , 221px 804px #FFF , 1136px 615px #FFF , 712px 1209px #FFF , 826px 1311px #FFF , 1787px 256px #FFF , 750px 998px #FFF , 1314px 296px #FFF , 561px 1641px #FFF , 344px 265px #FFF , 449px 1689px #FFF , 336px 2px #FFF , 1878px 1886px #FFF , 1625px 978px #FFF , 1275px 530px #FFF , 400px 587px #FFF , 131px 163px #FFF , 779px 1855px #FFF , 29px 762px #FFF , 649px 74px #FFF , 648px 1936px #FFF , 1930px 380px #FFF , 1511px 1679px #FFF , 1977px 1056px #FFF , 101px 184px #FFF , 1417px 754px #FFF , 342px 1089px #FFF , 1595px 1268px #FFF , 955px 908px #FFF , 1426px 1616px #FFF , 1079px 1615px #FFF , 567px 552px #FFF , 1623px 508px #FFF , 355px 795px #FFF , 405px 496px #FFF , 1905px 1985px #FFF , 780px 1428px #FFF , 174px 719px #FFF , 967px 1880px #FFF , 154px 1090px #FFF , 1403px 702px #FFF , 811px 1050px #FFF , 1789px 1540px #FFF , 979px 1116px #FFF , 248px 620px #FFF , 1805px 1061px #FFF , 367px 45px #FFF , 836px 894px #FFF , 780px 824px #FFF , 1319px 77px #FFF , 1391px 1535px #FFF , 773px 1425px #FFF , 1858px 1750px #FFF , 904px 43px #FFF , 1086px 610px #FFF , 678px 775px #FFF , 748px 1630px #FFF , 707px 1179px #FFF , 687px 1231px #FFF , 250px 1874px #FFF , 1775px 125px #FFF , 1511px 1945px #FFF , 852px 1177px #FFF , 1466px 272px #FFF , 1514px 198px #FFF , 752px 1247px #FFF , 576px 304px #FFF , 863px 1536px #FFF , 1023px 1954px #FFF , 243px 892px #FFF , 1701px 1243px #FFF , 991px 865px #FFF , 676px 1265px #FFF , 1488px 1003px #FFF , 514px 1347px #FFF , 56px 330px #FFF , 1752px 707px #FFF , 497px 1221px #FFF , 793px 94px #FFF , 918px 1262px #FFF , 1004px 1908px #FFF , 1933px 1643px #FFF , 315px 809px #FFF , 1217px 1082px #FFF , 364px 490px #FFF , 307px 636px #FFF , 1120px 1448px #FFF , 1529px 32px #FFF , 1120px 1936px #FFF , 1737px 928px #FFF , 45px 128px #FFF , 1480px 845px #FFF , 1742px 527px #FFF , 1537px 882px #FFF , 809px 1636px #FFF , 967px 1004px #FFF , 356px 1470px #FFF , 121px 1058px #FFF , 87px 1929px #FFF , 879px 1208px #FFF , 460px 1306px #FFF , 652px 595px #FFF , 1114px 1411px #FFF , 1585px 818px #FFF , 1057px 1613px #FFF , 1436px 122px #FFF , 84px 1934px #FFF , 1932px 124px #FFF , 967px 827px #FFF , 918px 1314px #FFF , 649px 112px #FFF , 1754px 1221px #FFF , 1360px 532px #FFF , 700px 1935px #FFF , 1339px 30px #FFF , 99px 1278px #FFF , 1099px 865px #FFF , 1306px 542px #FFF , 754px 1447px #FFF , 565px 852px #FFF , 1687px 766px #FFF , 1114px 1406px #FFF , 1511px 244px #FFF , 1434px 1607px #FFF , 1813px 378px #FFF , 1716px 1527px #FFF , 505px 1857px #FFF , 1863px 1904px #FFF , 1606px 1204px #FFF , 1358px 237px #FFF , 920px 1591px #FFF , 848px 286px #FFF , 977px 559px #FFF , 1501px 1014px #FFF , 1179px 88px #FFF , 578px 164px #FFF , 929px 799px #FFF , 617px 607px #FFF , 1834px 1995px #FFF , 1117px 924px #FFF , 1343px 27px #FFF , 1683px 435px #FFF , 1350px 160px #FFF , 304px 869px #FFF , 660px 1088px #FFF , 1409px 536px #FFF , 983px 1674px #FFF , 1592px 961px #FFF , 1921px 406px #FFF , 1390px 600px #FFF , 1848px 241px #FFF , 1858px 1551px #FFF , 1787px 1872px #FFF , 1745px 1647px #FFF , 300px 1663px #FFF , 296px 1215px #FFF , 1412px 1694px #FFF , 669px 1274px #FFF , 911px 400px #FFF , 1592px 334px #FFF , 528px 692px #FFF , 337px 909px #FFF , 256px 769px #FFF , 269px 1950px #FFF , 1336px 573px #FFF , 937px 1708px #FFF , 371px 1443px #FFF , 1604px 25px #FFF , 1761px 12px #FFF , 1192px 1980px #FFF , 1259px 1280px #FFF , 815px 761px #FFF , 1717px 241px #FFF , 518px 1401px #FFF , 709px 18px #FFF , 301px 886px #FFF , 1857px 292px #FFF , 274px 451px #FFF , 230px 1639px #FFF , 1404px 729px #FFF , 368px 1503px #FFF , 1138px 1018px #FFF , 1950px 1763px #FFF , 144px 1078px #FFF , 1390px 1456px #FFF , 1716px 1570px #FFF , 250px 1423px #FFF , 750px 376px #FFF , 1454px 1450px #FFF , 1075px 413px #FFF , 1442px 770px #FFF , 1294px 575px #FFF , 1667px 1921px #FFF , 1102px 278px #FFF , 1577px 1397px #FFF , 941px 735px #FFF , 1776px 448px #FFF , 1951px 259px #FFF , 974px 1129px #FFF , 602px 1114px #FFF , 1180px 808px #FFF , 828px 91px #FFF , 1178px 356px #FFF , 824px 261px #FFF , 1050px 486px #FFF , 738px 1318px #FFF , 587px 726px #FFF , 1388px 1854px #FFF , 829px 1384px #FFF , 928px 786px #FFF , 709px 1150px #FFF , 771px 1736px #FFF , 1635px 1210px #FFF , 171px 1102px #FFF , 1622px 499px #FFF , 656px 1510px #FFF , 682px 512px #FFF , 1672px 1702px #FFF , 1738px 1155px #FFF , 190px 376px #FFF , 890px 317px #FFF , 1261px 962px #FFF , 1345px 736px #FFF , 1389px 1124px #FFF , 93px 1688px #FFF , 767px 1607px #FFF , 825px 1798px #FFF , 1959px 1058px #FFF , 107px 568px #FFF , 285px 946px #FFF , 171px 274px #FFF , 53px 1325px #FFF , 826px 986px #FFF , 1977px 819px #FFF , 1554px 325px #FFF , 1497px 198px #FFF , 1123px 1497px #FFF , 1877px 210px #FFF , 1294px 24px #FFF , 1893px 1866px #FFF , 731px 1161px #FFF , 168px 1743px #FFF , 1051px 133px #FFF , 610px 138px #FFF , 1157px 1023px #FFF , 1045px 1255px #FFF , 336px 455px #FFF , 951px 1041px #FFF , 1476px 929px #FFF , 836px 1900px #FFF , 936px 1270px #FFF , 855px 917px #FFF , 1701px 1463px #FFF , 1485px 1876px #FFF , 1241px 1369px #FFF , 856px 1460px #FFF , 651px 174px #FFF , 559px 495px #FFF , 1365px 41px #FFF , 1114px 62px #FFF , 730px 1343px #FFF , 36px 762px #FFF , 1871px 1859px #FFF , 1259px 1535px #FFF , 376px 493px #FFF , 1749px 1415px #FFF , 1846px 1452px #FFF , 1143px 1181px #FFF , 1222px 1735px #FFF , 1693px 333px #FFF , 1007px 495px #FFF , 1188px 73px #FFF , 1151px 1881px #FFF , 7px 492px #FFF , 1487px 1633px #FFF , 1739px 1625px #FFF , 1183px 1780px #FFF , 861px 1316px #FFF , 34px 1737px #FFF , 1608px 1245px #FFF , 553px 360px #FFF , 1828px 1081px #FFF , 996px 406px #FFF , 1929px 1925px #FFF , 744px 477px #FFF , 1066px 213px #FFF , 1949px 975px #FFF , 923px 120px #FFF , 76px 750px #FFF , 1927px 1439px #FFF , 1491px 680px #FFF , 1230px 1111px #FFF , 1048px 1162px #FFF , 1776px 1107px #FFF , 1139px 131px #FFF , 749px 403px #FFF , 721px 1851px #FFF , 669px 110px #FFF , 864px 1649px #FFF , 811px 1988px #FFF , 789px 1357px #FFF , 1138px 139px #FFF , 825px 1879px #FFF , 1996px 1012px #FFF , 562px 226px #FFF , 670px 112px #FFF , 274px 26px #FFF , 307px 472px #FFF , 253px 1423px #FFF , 730px 1497px #FFF , 965px 194px #FFF , 541px 542px #FFF , 1166px 1568px #FFF , 1761px 886px #FFF , 1509px 1036px #FFF , 979px 1903px #FFF , 466px 905px #FFF , 1995px 837px #FFF , 689px 1244px #FFF , 1114px 1653px #FFF , 1596px 471px #FFF , 374px 1631px #FFF , 251px 1432px #FFF , 1500px 898px #FFF , 934px 1795px #FFF , 1887px 1138px #FFF , 1739px 1501px #FFF , 1933px 246px #FFF , 380px 1195px #FFF , 1964px 1903px #FFF , 1840px 145px #FFF , 663px 163px #FFF , 356px 173px #FFF , 561px 1423px #FFF , 725px 660px #FFF , 817px 1404px #FFF , 412px 1275px #FFF , 1508px 591px #FFF , 1015px 1619px #FFF , 306px 256px #FFF , 1739px 374px #FFF , 869px 1482px #FFF , 1422px 1377px #FFF , 141px 1038px #FFF , 1766px 846px #FFF , 259px 1840px #FFF , 394px 27px #FFF , 1031px 607px #FFF , 1705px 569px #FFF , 109px 1831px #FFF , 1033px 1504px #FFF , 722px 140px #FFF , 392px 1494px #FFF , 1263px 989px #FFF , 641px 1230px #FFF;
  animation: animStar 50s linear infinite;
}
#stars:after {
  content: " ";
  position: absolute;
  left: 2000px;
  width: 1px;
  height: 1px;
  background: transparent;
  box-shadow: 1069px 1980px #FFF , 1553px 1152px #FFF , 508px 752px #FFF , 1088px 734px #FFF , 1449px 140px #FFF , 1833px 1041px #FFF , 417px 1965px #FFF , 969px 933px #FFF , 1767px 1694px #FFF , 1282px 184px #FFF , 850px 1675px #FFF , 1692px 415px #FFF , 1732px 941px #FFF , 1378px 709px #FFF , 1438px 536px #FFF , 742px 1380px #FFF , 873px 1511px #FFF , 907px 991px #FFF , 1839px 1661px #FFF , 1688px 771px #FFF , 994px 1086px #FFF , 913px 1619px #FFF , 1011px 1106px #FFF , 1325px 1724px #FFF , 1994px 1267px #FFF , 936px 1272px #FFF , 1997px 1933px #FFF , 1180px 6px #FFF , 1735px 1997px #FFF , 1357px 1337px #FFF , 1927px 1519px #FFF , 606px 1817px #FFF , 1782px 706px #FFF , 280px 1980px #FFF , 237px 380px #FFF , 702px 1936px #FFF , 564px 508px #FFF , 1192px 619px #FFF , 828px 1802px #FFF , 1750px 1751px #FFF , 171px 1251px #FFF , 499px 827px #FFF , 1192px 703px #FFF , 810px 1226px #FFF , 713px 551px #FFF , 954px 819px #FFF , 868px 520px #FFF , 1579px 1325px #FFF , 411px 341px #FFF , 212px 116px #FFF , 811px 1333px #FFF , 650px 1239px #FFF , 78px 1693px #FFF , 1298px 434px #FFF , 1369px 1530px #FFF , 749px 1974px #FFF , 57px 894px #FFF , 1814px 651px #FFF , 436px 837px #FFF , 402px 1006px #FFF , 84px 1426px #FFF , 1618px 1585px #FFF , 1464px 1841px #FFF , 693px 318px #FFF , 962px 1618px #FFF , 141px 910px #FFF , 545px 1633px #FFF , 84px 1683px #FFF , 1170px 1710px #FFF , 1544px 1169px #FFF , 987px 857px #FFF , 372px 1588px #FFF , 318px 12px #FFF , 294px 1103px #FFF , 1537px 879px #FFF , 456px 949px #FFF , 566px 1960px #FFF , 1015px 785px #FFF , 23px 1088px #FFF , 625px 1295px #FFF , 149px 171px #FFF , 1153px 1188px #FFF , 1636px 229px #FFF , 1954px 72px #FFF , 1779px 1650px #FFF , 791px 1049px #FFF , 810px 451px #FFF , 1969px 663px #FFF , 591px 526px #FFF , 641px 968px #FFF , 1232px 471px #FFF , 353px 383px #FFF , 362px 1131px #FFF , 1237px 596px #FFF , 1544px 916px #FFF , 144px 1233px #FFF , 365px 1143px #FFF , 1768px 961px #FFF , 1907px 1925px #FFF , 791px 1068px #FFF , 1943px 943px #FFF , 1926px 1603px #FFF , 295px 1088px #FFF , 352px 628px #FFF , 94px 1730px #FFF , 235px 989px #FFF , 63px 841px #FFF , 1763px 36px #FFF , 1078px 736px #FFF , 1636px 1204px #FFF , 1733px 1708px #FFF , 375px 476px #FFF , 1517px 1633px #FFF , 1864px 83px #FFF , 1734px 408px #FFF , 92px 1157px #FFF , 1183px 1955px #FFF , 1089px 514px #FFF , 155px 1734px #FFF , 1184px 1304px #FFF , 908px 1441px #FFF , 1436px 588px #FFF , 635px 404px #FFF , 1322px 366px #FFF , 262px 585px #FFF , 1913px 1719px #FFF , 929px 1449px #FFF , 1223px 856px #FFF , 1870px 1351px #FFF , 208px 1694px #FFF , 668px 1743px #FFF , 218px 1201px #FFF , 749px 1453px #FFF , 890px 1535px #FFF , 1147px 1089px #FFF , 402px 43px #FFF , 146px 878px #FFF , 682px 1183px #FFF , 777px 293px #FFF , 349px 398px #FFF , 1082px 1954px #FFF , 1721px 1122px #FFF , 942px 1538px #FFF , 1549px 184px #FFF , 1705px 1070px #FFF , 1461px 1379px #FFF , 690px 1883px #FFF , 1506px 1622px #FFF , 85px 282px #FFF , 912px 1227px #FFF , 1275px 34px #FFF , 647px 1257px #FFF , 609px 1900px #FFF , 88px 1825px #FFF , 38px 850px #FFF , 749px 1934px #FFF , 110px 850px #FFF , 1883px 524px #FFF , 1871px 1990px #FFF , 874px 1999px #FFF , 6px 783px #FFF , 571px 1763px #FFF , 306px 928px #FFF , 1637px 1276px #FFF , 86px 781px #FFF , 1467px 976px #FFF , 1873px 109px #FFF , 1908px 1918px #FFF , 1441px 1707px #FFF , 1858px 345px #FFF , 404px 271px #FFF , 921px 275px #FFF , 1017px 1287px #FFF , 1904px 130px #FFF , 510px 32px #FFF , 1577px 1142px #FFF , 92px 119px #FFF , 1523px 1012px #FFF , 1638px 1757px #FFF , 458px 330px #FFF , 804px 1722px #FFF , 1044px 815px #FFF , 79px 1054px #FFF , 1202px 1961px #FFF , 1515px 986px #FFF , 721px 1462px #FFF , 1803px 302px #FFF , 718px 952px #FFF , 1729px 335px #FFF , 458px 398px #FFF , 1913px 1582px #FFF , 401px 831px #FFF , 864px 1433px #FFF , 823px 1848px #FFF , 597px 481px #FFF , 338px 128px #FFF , 1337px 428px #FFF , 1542px 1605px #FFF , 1696px 488px #FFF , 982px 1838px #FFF , 1249px 100px #FFF , 1246px 1381px #FFF , 993px 1826px #FFF , 409px 993px #FFF , 2000px 1241px #FFF , 432px 585px #FFF , 367px 416px #FFF , 1553px 304px #FFF , 1774px 1021px #FFF , 1298px 1235px #FFF , 1252px 677px #FFF , 1054px 1024px #FFF , 584px 1754px #FFF , 160px 735px #FFF , 1111px 1822px #FFF , 985px 1642px #FFF , 1869px 862px #FFF , 1384px 1165px #FFF , 469px 762px #FFF , 526px 375px #FFF , 1077px 1887px #FFF , 38px 1495px #FFF , 787px 1875px #FFF , 343px 141px #FFF , 1928px 1119px #FFF , 437px 1806px #FFF , 1950px 487px #FFF , 738px 1353px #FFF , 284px 1176px #FFF , 1034px 1954px #FFF , 383px 674px #FFF , 1836px 1030px #FFF , 128px 1593px #FFF , 923px 148px #FFF , 1176px 6px #FFF , 1607px 304px #FFF , 1066px 4px #FFF , 1735px 1020px #FFF , 1528px 799px #FFF , 628px 1836px #FFF , 835px 856px #FFF , 67px 1007px #FFF , 1333px 1845px #FFF , 207px 1502px #FFF , 1229px 1796px #FFF , 458px 823px #FFF , 1942px 75px #FFF , 919px 895px #FFF , 1723px 1897px #FFF , 214px 1496px #FFF , 423px 1809px #FFF , 1573px 1294px #FFF , 1106px 215px #FFF , 372px 305px #FFF , 1864px 198px #FFF , 1347px 1320px #FFF , 200px 1836px #FFF , 1025px 1208px #FFF , 1519px 910px #FFF , 1943px 506px #FFF , 728px 434px #FFF , 1893px 1602px #FFF , 498px 214px #FFF , 1138px 1342px #FFF , 871px 302px #FFF , 1397px 1767px #FFF , 295px 1433px #FFF , 280px 54px #FFF , 1364px 235px #FFF , 804px 1003px #FFF , 1183px 9px #FFF , 480px 207px #FFF , 510px 234px #FFF , 1282px 1818px #FFF , 233px 1713px #FFF , 1195px 1366px #FFF , 1776px 411px #FFF , 1486px 414px #FFF , 1644px 1814px #FFF , 1610px 515px #FFF , 876px 429px #FFF , 1895px 1020px #FFF , 1449px 856px #FFF , 1314px 818px #FFF , 930px 1329px #FFF , 1335px 1863px #FFF , 114px 58px #FFF , 1403px 665px #FFF , 78px 1026px #FFF , 1253px 1932px #FFF , 619px 817px #FFF , 1873px 908px #FFF , 617px 1817px #FFF , 1294px 444px #FFF , 286px 1684px #FFF , 135px 1000px #FFF , 1569px 1308px #FFF , 835px 1645px #FFF , 1642px 1975px #FFF , 1093px 1392px #FFF , 1994px 23px #FFF , 733px 1302px #FFF , 305px 1417px #FFF , 709px 708px #FFF , 872px 1878px #FFF , 1972px 1086px #FFF , 1428px 1839px #FFF , 1132px 68px #FFF , 870px 159px #FFF , 1603px 358px #FFF , 720px 41px #FFF , 1325px 975px #FFF , 1674px 1832px #FFF , 231px 876px #FFF , 1573px 1881px #FFF , 40px 1671px #FFF , 1025px 1642px #FFF , 314px 740px #FFF , 1262px 970px #FFF , 1967px 1139px #FFF , 1987px 1184px #FFF , 376px 1872px #FFF , 1176px 1535px #FFF , 467px 303px #FFF , 324px 745px #FFF , 1253px 1261px #FFF , 1048px 575px #FFF , 608px 414px #FFF , 549px 661px #FFF , 536px 897px #FFF , 1917px 884px #FFF , 796px 143px #FFF , 1972px 854px #FFF , 1172px 369px #FFF , 1233px 1243px #FFF , 1714px 1574px #FFF , 379px 213px #FFF , 388px 1111px #FFF , 848px 496px #FFF , 882px 573px #FFF , 764px 830px #FFF , 365px 1066px #FFF , 626px 822px #FFF , 688px 1981px #FFF , 1682px 990px #FFF , 889px 809px #FFF , 221px 804px #FFF , 1136px 615px #FFF , 712px 1209px #FFF , 826px 1311px #FFF , 1787px 256px #FFF , 750px 998px #FFF , 1314px 296px #FFF , 561px 1641px #FFF , 344px 265px #FFF , 449px 1689px #FFF , 336px 2px #FFF , 1878px 1886px #FFF , 1625px 978px #FFF , 1275px 530px #FFF , 400px 587px #FFF , 131px 163px #FFF , 779px 1855px #FFF , 29px 762px #FFF , 649px 74px #FFF , 648px 1936px #FFF , 1930px 380px #FFF , 1511px 1679px #FFF , 1977px 1056px #FFF , 101px 184px #FFF , 1417px 754px #FFF , 342px 1089px #FFF , 1595px 1268px #FFF , 955px 908px #FFF , 1426px 1616px #FFF , 1079px 1615px #FFF , 567px 552px #FFF , 1623px 508px #FFF , 355px 795px #FFF , 405px 496px #FFF , 1905px 1985px #FFF , 780px 1428px #FFF , 174px 719px #FFF , 967px 1880px #FFF , 154px 1090px #FFF , 1403px 702px #FFF , 811px 1050px #FFF , 1789px 1540px #FFF , 979px 1116px #FFF , 248px 620px #FFF , 1805px 1061px #FFF , 367px 45px #FFF , 836px 894px #FFF , 780px 824px #FFF , 1319px 77px #FFF , 1391px 1535px #FFF , 773px 1425px #FFF , 1858px 1750px #FFF , 904px 43px #FFF , 1086px 610px #FFF , 678px 775px #FFF , 748px 1630px #FFF , 707px 1179px #FFF , 687px 1231px #FFF , 250px 1874px #FFF , 1775px 125px #FFF , 1511px 1945px #FFF , 852px 1177px #FFF , 1466px 272px #FFF , 1514px 198px #FFF , 752px 1247px #FFF , 576px 304px #FFF , 863px 1536px #FFF , 1023px 1954px #FFF , 243px 892px #FFF , 1701px 1243px #FFF , 991px 865px #FFF , 676px 1265px #FFF , 1488px 1003px #FFF , 514px 1347px #FFF , 56px 330px #FFF , 1752px 707px #FFF , 497px 1221px #FFF , 793px 94px #FFF , 918px 1262px #FFF , 1004px 1908px #FFF , 1933px 1643px #FFF , 315px 809px #FFF , 1217px 1082px #FFF , 364px 490px #FFF , 307px 636px #FFF , 1120px 1448px #FFF , 1529px 32px #FFF , 1120px 1936px #FFF , 1737px 928px #FFF , 45px 128px #FFF , 1480px 845px #FFF , 1742px 527px #FFF , 1537px 882px #FFF , 809px 1636px #FFF , 967px 1004px #FFF , 356px 1470px #FFF , 121px 1058px #FFF , 87px 1929px #FFF , 879px 1208px #FFF , 460px 1306px #FFF , 652px 595px #FFF , 1114px 1411px #FFF , 1585px 818px #FFF , 1057px 1613px #FFF , 1436px 122px #FFF , 84px 1934px #FFF , 1932px 124px #FFF , 967px 827px #FFF , 918px 1314px #FFF , 649px 112px #FFF , 1754px 1221px #FFF , 1360px 532px #FFF , 700px 1935px #FFF , 1339px 30px #FFF , 99px 1278px #FFF , 1099px 865px #FFF , 1306px 542px #FFF , 754px 1447px #FFF , 565px 852px #FFF , 1687px 766px #FFF , 1114px 1406px #FFF , 1511px 244px #FFF , 1434px 1607px #FFF , 1813px 378px #FFF , 1716px 1527px #FFF , 505px 1857px #FFF , 1863px 1904px #FFF , 1606px 1204px #FFF , 1358px 237px #FFF , 920px 1591px #FFF , 848px 286px #FFF , 977px 559px #FFF , 1501px 1014px #FFF , 1179px 88px #FFF , 578px 164px #FFF , 929px 799px #FFF , 617px 607px #FFF , 1834px 1995px #FFF , 1117px 924px #FFF , 1343px 27px #FFF , 1683px 435px #FFF , 1350px 160px #FFF , 304px 869px #FFF , 660px 1088px #FFF , 1409px 536px #FFF , 983px 1674px #FFF , 1592px 961px #FFF , 1921px 406px #FFF , 1390px 600px #FFF , 1848px 241px #FFF , 1858px 1551px #FFF , 1787px 1872px #FFF , 1745px 1647px #FFF , 300px 1663px #FFF , 296px 1215px #FFF , 1412px 1694px #FFF , 669px 1274px #FFF , 911px 400px #FFF , 1592px 334px #FFF , 528px 692px #FFF , 337px 909px #FFF , 256px 769px #FFF , 269px 1950px #FFF , 1336px 573px #FFF , 937px 1708px #FFF , 371px 1443px #FFF , 1604px 25px #FFF , 1761px 12px #FFF , 1192px 1980px #FFF , 1259px 1280px #FFF , 815px 761px #FFF , 1717px 241px #FFF , 518px 1401px #FFF , 709px 18px #FFF , 301px 886px #FFF , 1857px 292px #FFF , 274px 451px #FFF , 230px 1639px #FFF , 1404px 729px #FFF , 368px 1503px #FFF , 1138px 1018px #FFF , 1950px 1763px #FFF , 144px 1078px #FFF , 1390px 1456px #FFF , 1716px 1570px #FFF , 250px 1423px #FFF , 750px 376px #FFF , 1454px 1450px #FFF , 1075px 413px #FFF , 1442px 770px #FFF , 1294px 575px #FFF , 1667px 1921px #FFF , 1102px 278px #FFF , 1577px 1397px #FFF , 941px 735px #FFF , 1776px 448px #FFF , 1951px 259px #FFF , 974px 1129px #FFF , 602px 1114px #FFF , 1180px 808px #FFF , 828px 91px #FFF , 1178px 356px #FFF , 824px 261px #FFF , 1050px 486px #FFF , 738px 1318px #FFF , 587px 726px #FFF , 1388px 1854px #FFF , 829px 1384px #FFF , 928px 786px #FFF , 709px 1150px #FFF , 771px 1736px #FFF , 1635px 1210px #FFF , 171px 1102px #FFF , 1622px 499px #FFF , 656px 1510px #FFF , 682px 512px #FFF , 1672px 1702px #FFF , 1738px 1155px #FFF , 190px 376px #FFF , 890px 317px #FFF , 1261px 962px #FFF , 1345px 736px #FFF , 1389px 1124px #FFF , 93px 1688px #FFF , 767px 1607px #FFF , 825px 1798px #FFF , 1959px 1058px #FFF , 107px 568px #FFF , 285px 946px #FFF , 171px 274px #FFF , 53px 1325px #FFF , 826px 986px #FFF , 1977px 819px #FFF , 1554px 325px #FFF , 1497px 198px #FFF , 1123px 1497px #FFF , 1877px 210px #FFF , 1294px 24px #FFF , 1893px 1866px #FFF , 731px 1161px #FFF , 168px 1743px #FFF , 1051px 133px #FFF , 610px 138px #FFF , 1157px 1023px #FFF , 1045px 1255px #FFF , 336px 455px #FFF , 951px 1041px #FFF , 1476px 929px #FFF , 836px 1900px #FFF , 936px 1270px #FFF , 855px 917px #FFF , 1701px 1463px #FFF , 1485px 1876px #FFF , 1241px 1369px #FFF , 856px 1460px #FFF , 651px 174px #FFF , 559px 495px #FFF , 1365px 41px #FFF , 1114px 62px #FFF , 730px 1343px #FFF , 36px 762px #FFF , 1871px 1859px #FFF , 1259px 1535px #FFF , 376px 493px #FFF , 1749px 1415px #FFF , 1846px 1452px #FFF , 1143px 1181px #FFF , 1222px 1735px #FFF , 1693px 333px #FFF , 1007px 495px #FFF , 1188px 73px #FFF , 1151px 1881px #FFF , 7px 492px #FFF , 1487px 1633px #FFF , 1739px 1625px #FFF , 1183px 1780px #FFF , 861px 1316px #FFF , 34px 1737px #FFF , 1608px 1245px #FFF , 553px 360px #FFF , 1828px 1081px #FFF , 996px 406px #FFF , 1929px 1925px #FFF , 744px 477px #FFF , 1066px 213px #FFF , 1949px 975px #FFF , 923px 120px #FFF , 76px 750px #FFF , 1927px 1439px #FFF , 1491px 680px #FFF , 1230px 1111px #FFF , 1048px 1162px #FFF , 1776px 1107px #FFF , 1139px 131px #FFF , 749px 403px #FFF , 721px 1851px #FFF , 669px 110px #FFF , 864px 1649px #FFF , 811px 1988px #FFF , 789px 1357px #FFF , 1138px 139px #FFF , 825px 1879px #FFF , 1996px 1012px #FFF , 562px 226px #FFF , 670px 112px #FFF , 274px 26px #FFF , 307px 472px #FFF , 253px 1423px #FFF , 730px 1497px #FFF , 965px 194px #FFF , 541px 542px #FFF , 1166px 1568px #FFF , 1761px 886px #FFF , 1509px 1036px #FFF , 979px 1903px #FFF , 466px 905px #FFF , 1995px 837px #FFF , 689px 1244px #FFF , 1114px 1653px #FFF , 1596px 471px #FFF , 374px 1631px #FFF , 251px 1432px #FFF , 1500px 898px #FFF , 934px 1795px #FFF , 1887px 1138px #FFF , 1739px 1501px #FFF , 1933px 246px #FFF , 380px 1195px #FFF , 1964px 1903px #FFF , 1840px 145px #FFF , 663px 163px #FFF , 356px 173px #FFF , 561px 1423px #FFF , 725px 660px #FFF , 817px 1404px #FFF , 412px 1275px #FFF , 1508px 591px #FFF , 1015px 1619px #FFF , 306px 256px #FFF , 1739px 374px #FFF , 869px 1482px #FFF , 1422px 1377px #FFF , 141px 1038px #FFF , 1766px 846px #FFF , 259px 1840px #FFF , 394px 27px #FFF , 1031px 607px #FFF , 1705px 569px #FFF , 109px 1831px #FFF , 1033px 1504px #FFF , 722px 140px #FFF , 392px 1494px #FFF , 1263px 989px #FFF , 641px 1230px #FFF;
}

#stars2 {
  width: 2px;
  height: 2px;
  background: transparent;
  box-shadow: 308px 685px #FFF , 1068px 348px #FFF , 866px 1823px #FFF , 1476px 803px #FFF , 270px 1574px #FFF , 3px 1764px #FFF , 363px 1018px #FFF , 1517px 1991px #FFF , 1960px 756px #FFF , 1619px 1839px #FFF , 891px 1411px #FFF , 1405px 876px #FFF , 1380px 511px #FFF , 1339px 751px #FFF , 982px 1113px #FFF , 48px 290px #FFF , 1460px 81px #FFF , 51px 1946px #FFF , 1084px 1417px #FFF , 1187px 1166px #FFF , 381px 309px #FFF , 115px 34px #FFF , 1631px 763px #FFF , 1487px 1280px #FFF , 825px 764px #FFF , 1280px 781px #FFF , 47px 1422px #FFF , 618px 1097px #FFF , 1913px 1200px #FFF , 1476px 1495px #FFF , 305px 411px #FFF , 215px 890px #FFF , 55px 777px #FFF , 775px 1695px #FFF , 514px 428px #FFF , 949px 370px #FFF , 1197px 1118px #FFF , 125px 1434px #FFF , 776px 1322px #FFF , 1956px 1264px #FFF , 1655px 802px #FFF , 797px 1171px #FFF , 1140px 189px #FFF , 1314px 1586px #FFF , 1537px 841px #FFF , 1197px 1881px #FFF , 1288px 130px #FFF , 1961px 1482px #FFF , 1783px 862px #FFF , 439px 184px #FFF , 876px 1091px #FFF , 1673px 960px #FFF , 1810px 1747px #FFF , 486px 892px #FFF , 675px 47px #FFF , 1460px 606px #FFF , 1679px 140px #FFF , 103px 1640px #FFF , 478px 1496px #FFF , 840px 346px #FFF , 725px 1231px #FFF , 1243px 1017px #FFF , 1859px 983px #FFF , 1888px 1313px #FFF , 1336px 209px #FFF , 570px 384px #FFF , 1869px 1083px #FFF , 1769px 809px #FFF , 1057px 768px #FFF , 1324px 354px #FFF , 130px 96px #FFF , 508px 242px #FFF , 714px 809px #FFF , 1637px 1840px #FFF , 697px 897px #FFF , 322px 1680px #FFF , 66px 1927px #FFF , 122px 1141px #FFF , 946px 185px #FFF , 243px 393px #FFF , 814px 676px #FFF , 377px 1507px #FFF , 708px 959px #FFF , 2000px 2px #FFF , 89px 121px #FFF , 1073px 202px #FFF , 1159px 571px #FFF , 1054px 727px #FFF , 548px 1670px #FFF , 431px 944px #FFF , 594px 1536px #FFF , 1114px 1960px #FFF , 11px 709px #FFF , 624px 290px #FFF , 727px 499px #FFF , 1310px 1154px #FFF , 1636px 1453px #FFF , 84px 632px #FFF , 929px 1551px #FFF , 429px 407px #FFF , 1058px 656px #FFF , 1363px 1418px #FFF , 663px 640px #FFF , 1441px 1038px #FFF , 111px 1441px #FFF , 1160px 912px #FFF , 392px 1358px #FFF , 860px 475px #FFF , 986px 417px #FFF , 136px 494px #FFF , 534px 1978px #FFF , 591px 490px #FFF , 965px 295px #FFF , 82px 913px #FFF , 1505px 1482px #FFF , 452px 91px #FFF , 1161px 1814px #FFF , 1083px 1266px #FFF , 856px 1550px #FFF , 404px 410px #FFF , 1140px 1668px #FFF , 775px 1088px #FFF , 1920px 1817px #FFF , 782px 142px #FFF , 1403px 154px #FFF , 862px 1971px #FFF , 1076px 1308px #FFF , 498px 1706px #FFF , 102px 932px #FFF , 65px 5px #FFF , 1629px 1098px #FFF , 1921px 1491px #FFF , 1761px 972px #FFF , 715px 1532px #FFF , 1054px 1167px #FFF , 1314px 1918px #FFF , 665px 1697px #FFF , 327px 1414px #FFF , 216px 324px #FFF , 1996px 1457px #FFF , 901px 1925px #FFF , 39px 1775px #FFF , 1102px 1700px #FFF , 1929px 1175px #FFF , 858px 974px #FFF , 641px 1027px #FFF , 803px 349px #FFF , 832px 1470px #FFF , 1882px 562px #FFF , 798px 558px #FFF , 843px 978px #FFF , 1408px 1227px #FFF , 1498px 288px #FFF , 1743px 1365px #FFF , 72px 149px #FFF , 679px 272px #FFF , 1266px 1943px #FFF , 603px 554px #FFF , 201px 1256px #FFF , 1602px 411px #FFF , 630px 8px #FFF , 1247px 271px #FFF , 1570px 1503px #FFF , 57px 705px #FFF , 592px 376px #FFF , 1698px 497px #FFF , 1855px 1203px #FFF , 581px 768px #FFF , 1478px 72px #FFF , 543px 584px #FFF , 1364px 337px #FFF , 1767px 269px #FFF , 852px 260px #FFF , 1487px 797px #FFF , 753px 1223px #FFF , 1117px 914px #FFF , 1408px 569px #FFF , 628px 822px #FFF , 1441px 385px #FFF , 1110px 895px #FFF , 1120px 1590px #FFF , 753px 370px #FFF , 1244px 172px #FFF , 1772px 1786px #FFF , 64px 1910px #FFF , 723px 868px #FFF , 1908px 1798px #FFF , 577px 644px #FFF , 1679px 1792px #FFF , 1357px 754px #FFF , 598px 1240px #FFF , 1336px 848px #FFF , 1606px 432px #FFF , 863px 1457px #FFF , 1653px 1948px #FFF , 1081px 1471px #FFF , 2000px 1601px #FFF , 1457px 1340px #FFF , 1264px 302px #FFF , 912px 1737px #FFF;
  animation: animStar 100s linear infinite;
}
#stars2:after {
  content: " ";
  position: absolute;
  left: 2000px;
  width: 2px;
  height: 2px;
  background: transparent;
  box-shadow: 308px 685px #FFF , 1068px 348px #FFF , 866px 1823px #FFF , 1476px 803px #FFF , 270px 1574px #FFF , 3px 1764px #FFF , 363px 1018px #FFF , 1517px 1991px #FFF , 1960px 756px #FFF , 1619px 1839px #FFF , 891px 1411px #FFF , 1405px 876px #FFF , 1380px 511px #FFF , 1339px 751px #FFF , 982px 1113px #FFF , 48px 290px #FFF , 1460px 81px #FFF , 51px 1946px #FFF , 1084px 1417px #FFF , 1187px 1166px #FFF , 381px 309px #FFF , 115px 34px #FFF , 1631px 763px #FFF , 1487px 1280px #FFF , 825px 764px #FFF , 1280px 781px #FFF , 47px 1422px #FFF , 618px 1097px #FFF , 1913px 1200px #FFF , 1476px 1495px #FFF , 305px 411px #FFF , 215px 890px #FFF , 55px 777px #FFF , 775px 1695px #FFF , 514px 428px #FFF , 949px 370px #FFF , 1197px 1118px #FFF , 125px 1434px #FFF , 776px 1322px #FFF , 1956px 1264px #FFF , 1655px 802px #FFF , 797px 1171px #FFF , 1140px 189px #FFF , 1314px 1586px #FFF , 1537px 841px #FFF , 1197px 1881px #FFF , 1288px 130px #FFF , 1961px 1482px #FFF , 1783px 862px #FFF , 439px 184px #FFF , 876px 1091px #FFF , 1673px 960px #FFF , 1810px 1747px #FFF , 486px 892px #FFF , 675px 47px #FFF , 1460px 606px #FFF , 1679px 140px #FFF , 103px 1640px #FFF , 478px 1496px #FFF , 840px 346px #FFF , 725px 1231px #FFF , 1243px 1017px #FFF , 1859px 983px #FFF , 1888px 1313px #FFF , 1336px 209px #FFF , 570px 384px #FFF , 1869px 1083px #FFF , 1769px 809px #FFF , 1057px 768px #FFF , 1324px 354px #FFF , 130px 96px #FFF , 508px 242px #FFF , 714px 809px #FFF , 1637px 1840px #FFF , 697px 897px #FFF , 322px 1680px #FFF , 66px 1927px #FFF , 122px 1141px #FFF , 946px 185px #FFF , 243px 393px #FFF , 814px 676px #FFF , 377px 1507px #FFF , 708px 959px #FFF , 2000px 2px #FFF , 89px 121px #FFF , 1073px 202px #FFF , 1159px 571px #FFF , 1054px 727px #FFF , 548px 1670px #FFF , 431px 944px #FFF , 594px 1536px #FFF , 1114px 1960px #FFF , 11px 709px #FFF , 624px 290px #FFF , 727px 499px #FFF , 1310px 1154px #FFF , 1636px 1453px #FFF , 84px 632px #FFF , 929px 1551px #FFF , 429px 407px #FFF , 1058px 656px #FFF , 1363px 1418px #FFF , 663px 640px #FFF , 1441px 1038px #FFF , 111px 1441px #FFF , 1160px 912px #FFF , 392px 1358px #FFF , 860px 475px #FFF , 986px 417px #FFF , 136px 494px #FFF , 534px 1978px #FFF , 591px 490px #FFF , 965px 295px #FFF , 82px 913px #FFF , 1505px 1482px #FFF , 452px 91px #FFF , 1161px 1814px #FFF , 1083px 1266px #FFF , 856px 1550px #FFF , 404px 410px #FFF , 1140px 1668px #FFF , 775px 1088px #FFF , 1920px 1817px #FFF , 782px 142px #FFF , 1403px 154px #FFF , 862px 1971px #FFF , 1076px 1308px #FFF , 498px 1706px #FFF , 102px 932px #FFF , 65px 5px #FFF , 1629px 1098px #FFF , 1921px 1491px #FFF , 1761px 972px #FFF , 715px 1532px #FFF , 1054px 1167px #FFF , 1314px 1918px #FFF , 665px 1697px #FFF , 327px 1414px #FFF , 216px 324px #FFF , 1996px 1457px #FFF , 901px 1925px #FFF , 39px 1775px #FFF , 1102px 1700px #FFF , 1929px 1175px #FFF , 858px 974px #FFF , 641px 1027px #FFF , 803px 349px #FFF , 832px 1470px #FFF , 1882px 562px #FFF , 798px 558px #FFF , 843px 978px #FFF , 1408px 1227px #FFF , 1498px 288px #FFF , 1743px 1365px #FFF , 72px 149px #FFF , 679px 272px #FFF , 1266px 1943px #FFF , 603px 554px #FFF , 201px 1256px #FFF , 1602px 411px #FFF , 630px 8px #FFF , 1247px 271px #FFF , 1570px 1503px #FFF , 57px 705px #FFF , 592px 376px #FFF , 1698px 497px #FFF , 1855px 1203px #FFF , 581px 768px #FFF , 1478px 72px #FFF , 543px 584px #FFF , 1364px 337px #FFF , 1767px 269px #FFF , 852px 260px #FFF , 1487px 797px #FFF , 753px 1223px #FFF , 1117px 914px #FFF , 1408px 569px #FFF , 628px 822px #FFF , 1441px 385px #FFF , 1110px 895px #FFF , 1120px 1590px #FFF , 753px 370px #FFF , 1244px 172px #FFF , 1772px 1786px #FFF , 64px 1910px #FFF , 723px 868px #FFF , 1908px 1798px #FFF , 577px 644px #FFF , 1679px 1792px #FFF , 1357px 754px #FFF , 598px 1240px #FFF , 1336px 848px #FFF , 1606px 432px #FFF , 863px 1457px #FFF , 1653px 1948px #FFF , 1081px 1471px #FFF , 2000px 1601px #FFF , 1457px 1340px #FFF , 1264px 302px #FFF , 912px 1737px #FFF;
}

#stars3 {
  width: 3px;
  height: 3px;
  background: transparent;
  box-shadow: 1251px 159px #FFF , 1217px 1154px #FFF , 1728px 1638px #FFF , 743px 687px #FFF , 596px 1271px #FFF , 242px 700px #FFF , 1550px 1561px #FFF , 1298px 1567px #FFF , 1893px 54px #FFF , 899px 645px #FFF , 1583px 490px #FFF , 704px 821px #FFF , 845px 1151px #FFF , 886px 1422px #FFF , 167px 382px #FFF , 1237px 1779px #FFF , 1041px 993px #FFF , 1926px 1456px #FFF , 1618px 1769px #FFF , 271px 1073px #FFF , 240px 584px #FFF , 2000px 1411px #FFF , 512px 1490px #FFF , 1429px 1661px #FFF , 606px 189px #FFF , 128px 493px #FFF , 373px 240px #FFF , 1505px 207px #FFF , 423px 1392px #FFF , 184px 1663px #FFF , 1820px 757px #FFF , 918px 897px #FFF , 300px 464px #FFF , 1396px 1557px #FFF , 1480px 1085px #FFF , 519px 784px #FFF , 1699px 1162px #FFF , 872px 1746px #FFF , 1965px 201px #FFF , 1626px 504px #FFF , 505px 1405px #FFF , 1507px 903px #FFF , 880px 672px #FFF , 855px 1280px #FFF , 178px 817px #FFF , 1200px 535px #FFF , 1574px 1148px #FFF , 875px 1167px #FFF , 1956px 234px #FFF , 1250px 1598px #FFF , 1915px 766px #FFF , 1348px 376px #FFF , 463px 1531px #FFF , 91px 1154px #FFF , 1137px 955px #FFF , 777px 468px #FFF , 1705px 1711px #FFF , 113px 1908px #FFF , 598px 750px #FFF , 1232px 36px #FFF , 778px 181px #FFF , 721px 1686px #FFF , 1050px 1672px #FFF , 322px 1231px #FFF , 1563px 1944px #FFF , 1372px 1687px #FFF , 610px 825px #FFF , 1676px 456px #FFF , 719px 668px #FFF , 421px 1118px #FFF , 961px 1194px #FFF , 683px 828px #FFF , 189px 637px #FFF , 1406px 138px #FFF , 1265px 999px #FFF , 810px 419px #FFF , 1764px 829px #FFF , 472px 821px #FFF , 1705px 1889px #FFF , 673px 189px #FFF , 928px 1692px #FFF , 887px 61px #FFF , 1595px 1383px #FFF , 1289px 1031px #FFF , 1579px 1328px #FFF , 177px 926px #FFF , 901px 1927px #FFF , 959px 1385px #FFF , 1990px 239px #FFF , 912px 1279px #FFF , 1150px 1253px #FFF , 1705px 1205px #FFF , 1757px 241px #FFF , 1863px 266px #FFF , 714px 544px #FFF , 29px 376px #FFF , 815px 230px #FFF , 570px 218px #FFF , 171px 1779px #FFF , 1324px 1927px #FFF;
  animation: animStar 150s linear infinite;
}
#stars3:after {
  content: " ";
  position: absolute;
  left: 2000px;
  width: 3px;
  height: 3px;
  background: transparent;
  box-shadow: 1251px 159px #FFF , 1217px 1154px #FFF , 1728px 1638px #FFF , 743px 687px #FFF , 596px 1271px #FFF , 242px 700px #FFF , 1550px 1561px #FFF , 1298px 1567px #FFF , 1893px 54px #FFF , 899px 645px #FFF , 1583px 490px #FFF , 704px 821px #FFF , 845px 1151px #FFF , 886px 1422px #FFF , 167px 382px #FFF , 1237px 1779px #FFF , 1041px 993px #FFF , 1926px 1456px #FFF , 1618px 1769px #FFF , 271px 1073px #FFF , 240px 584px #FFF , 2000px 1411px #FFF , 512px 1490px #FFF , 1429px 1661px #FFF , 606px 189px #FFF , 128px 493px #FFF , 373px 240px #FFF , 1505px 207px #FFF , 423px 1392px #FFF , 184px 1663px #FFF , 1820px 757px #FFF , 918px 897px #FFF , 300px 464px #FFF , 1396px 1557px #FFF , 1480px 1085px #FFF , 519px 784px #FFF , 1699px 1162px #FFF , 872px 1746px #FFF , 1965px 201px #FFF , 1626px 504px #FFF , 505px 1405px #FFF , 1507px 903px #FFF , 880px 672px #FFF , 855px 1280px #FFF , 178px 817px #FFF , 1200px 535px #FFF , 1574px 1148px #FFF , 875px 1167px #FFF , 1956px 234px #FFF , 1250px 1598px #FFF , 1915px 766px #FFF , 1348px 376px #FFF , 463px 1531px #FFF , 91px 1154px #FFF , 1137px 955px #FFF , 777px 468px #FFF , 1705px 1711px #FFF , 113px 1908px #FFF , 598px 750px #FFF , 1232px 36px #FFF , 778px 181px #FFF , 721px 1686px #FFF , 1050px 1672px #FFF , 322px 1231px #FFF , 1563px 1944px #FFF , 1372px 1687px #FFF , 610px 825px #FFF , 1676px 456px #FFF , 719px 668px #FFF , 421px 1118px #FFF , 961px 1194px #FFF , 683px 828px #FFF , 189px 637px #FFF , 1406px 138px #FFF , 1265px 999px #FFF , 810px 419px #FFF , 1764px 829px #FFF , 472px 821px #FFF , 1705px 1889px #FFF , 673px 189px #FFF , 928px 1692px #FFF , 887px 61px #FFF , 1595px 1383px #FFF , 1289px 1031px #FFF , 1579px 1328px #FFF , 177px 926px #FFF , 901px 1927px #FFF , 959px 1385px #FFF , 1990px 239px #FFF , 912px 1279px #FFF , 1150px 1253px #FFF , 1705px 1205px #FFF , 1757px 241px #FFF , 1863px 266px #FFF , 714px 544px #FFF , 29px 376px #FFF , 815px 230px #FFF , 570px 218px #FFF , 171px 1779px #FFF , 1324px 1927px #FFF;
}

#title {
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  color: #FFF;
  text-align: center;
  font-family: "lato", sans-serif;
  font-weight: 300;
  font-size: 50px;
  letter-spacing: 10px;
  margin-top: -60px;
  padding-left: 10px;
}
#title span {
  background: -webkit-linear-gradient(white, #38495a);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

@keyframes animStar {
  from {
    transform: translateX(0px);
  }
  to {
    transform: translateX(-2000px);
  }
}


.box {
  width: auto ;
  height: 500px;
  /*background: #fff;*/
  margin-top:50px;
  margin-left: 100px;
  margin-right: 100px;
/*  border-radius:5px;
  box-shadow: 6px 18px 18px rgba(0, 0, 0, 0.08), -6px 18px 18px rgba(0, 0, 0, 0.08);*/
}

.animation{
  margin-top:20%;
  display:inline-block;
  margin-bottom:5%;
}

h1{
  font-size:32px;
  font-weight:400;
  text-transform:uppercase;
  margin:0;
}
p{
  font-size:16px;
  font-weight:700;
  margin:0;
}

a{
  color: #f6921e;
  font-weight: bold;
  text-decoration: none;
  margin-left:5px;
}

.one, .two, .three {
  display:block;
  float:left;
}

.one {
  background: url('data:image/svg+xml,%3Csvg%20version%3D%221.1%22%0A%09%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20xmlns%3Aa%3D%22http%3A%2F%2Fns.adobe.com%2FAdobeSVGViewerExtensions%2F3.0%2F%22%0A%09%20x%3D%220px%22%20y%3D%220px%22%20width%3D%2281px%22%20height%3D%2280.5px%22%20viewBox%3D%220%200%2081%2080.5%22%20style%3D%22overflow%3Ascroll%3Benable-background%3Anew%200%200%2081%2080.5%3B%22%0A%09%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cstyle%20type%3D%22text%2Fcss%22%3E%0A%09.st0%7Bfill%3A%23383838%3B%7D%0A%3C%2Fstyle%3E%0A%3Cdefs%3E%0A%3C%2Fdefs%3E%0A%3Cpath%20class%3D%22st0%22%20d%3D%22M30.3%2C68.2c1.2%2C0.2%2C2.3%2C0.9%2C3.8%2C1.2c1.6%2C0.3%2C2.7%2C0.6%2C4%2C0.4l4.9%2C9.6c0.6%2C0.9%2C1.4%2C1.1%2C2.3%2C0.9l15.3-4.9%0A%09c0.5-0.3%2C1-1%2C0.9-2.3l-1.8-10.6c2-1.6%2C3.6-3.7%2C5.3-5.8l10.5%2C0.6c1.1%2C0.6%2C2.1-0.4%2C2.3-1.1L81%2C40.7c0.2-0.8-0.4-2.1-1.1-2.3l-10.2-3.8%0A%09c-0.3-2.5-1.4-4.8-2.5-7.5l5.9-8.5c0.6-1.1%2C0.4-1.9-0.2-2.9l-12-10.7c-0.3-0.5-1.6-0.3-2.5%2C0.3l-8%2C6.9c-1.2-0.2-2.3-0.9-3.8-1.2%0A%09c-1.6-0.3-2.7-0.6-4-0.4L37.7%2C1c-0.6-0.9-1.4-1.1-2.3-0.9L20.1%2C5c-0.5%2C0.3-1%2C1-0.9%2C2.3l1.8%2C10.6c-2%2C1.6-3.6%2C3.7-5.3%2C5.8L5.3%2C23%0A%09c-0.8-0.2-1.7%2C0.4-2%2C1.6L0%2C40.2c-0.2%2C0.8%2C0.4%2C2.1%2C1.1%2C2.3l9.8%2C3.7c0.7%2C2.6%2C1.4%2C5.2%2C2.5%2C7.5l-6%2C8.9c-0.6%2C0.7-0.4%2C2%2C0.3%2C2.5l12%2C10.7%0A%09c0.7%2C0.5%2C1.9%2C0.8%2C2.4%2C0.1L30.3%2C68.2z%20M26.7%2C37.3c1.6-7.4%2C9.1-12.3%2C16.5-10.8S55.6%2C35.7%2C54%2C43.1c-1.6%2C7.4-9.1%2C12.3-16.5%2C10.7%0A%09C30.1%2C52.3%2C25.1%2C44.7%2C26.7%2C37.3L26.7%2C37.3z%22%2F%3E%0A%3C%2Fsvg%3E');
  width:80px;
  height:80px;
  background-size:100% 100%;
  background-repeat:no-repeat;
  margin-top:-10px;
  margin-right:8px;
}

.two {
  background: url('data:image/svg+xml,%3Csvg%20version%3D%221.1%22%0A%09%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20xmlns%3Aa%3D%22http%3A%2F%2Fns.adobe.com%2FAdobeSVGViewerExtensions%2F3.0%2F%22%0A%09%20x%3D%220px%22%20y%3D%220px%22%20width%3D%22103px%22%20height%3D%22103.7px%22%20viewBox%3D%220%200%20103%20103.7%22%0A%09%20style%3D%22overflow%3Ascroll%3Benable-background%3Anew%200%200%20103%20103.7%3B%22%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cstyle%20type%3D%22text%2Fcss%22%3E%0A%09.st0%7Bfill%3A%23F6921E%3B%7D%0A%3C%2Fstyle%3E%0A%3Cdefs%3E%0A%3C%2Fdefs%3E%0A%3Cpath%20class%3D%22st0%22%20d%3D%22M87.3%2C64.8c0.3-1.5%2C1.1-2.9%2C1.6-4.9c0.4-2%2C0.7-3.5%2C0.5-5.1l12.3-6.3c1.2-0.8%2C1.4-1.8%2C1.1-2.9l-6.3-19.6%0A%09c-0.4-0.6-1.3-1.3-2.9-1.1l-13.5%2C2.3c-2.1-2.5-4.7-4.7-7.4-6.8l0.8-13.4C74.3%2C5.8%2C73%2C4.5%2C72%2C4.3L52.1%2C0c-1-0.2-2.7%2C0.5-2.9%2C1.5%0A%09l-4.8%2C13c-3.2%2C0.4-6.1%2C1.8-9.5%2C3.2l-10.9-7.5c-1.4-0.8-2.5-0.5-3.7%2C0.3L6.5%2C25.8c-0.6%2C0.4-0.4%2C2%2C0.4%2C3.2l8.8%2C10.2%0A%09c-0.3%2C1.5-1.1%2C2.9-1.5%2C4.9c-0.4%2C2-0.7%2C3.5-0.6%2C5.1L1.2%2C55.4c-1.2%2C0.8-1.4%2C1.8-1.1%2C2.9l6.3%2C19.6c0.4%2C0.6%2C1.3%2C1.3%2C2.9%2C1.1l13.5-2.3%0A%09c2.1%2C2.5%2C4.7%2C4.7%2C7.4%2C6.8l-0.8%2C13.4c-0.2%2C1%2C0.6%2C2.2%2C2.1%2C2.5l20%2C4.2c1%2C0.2%2C2.7-0.5%2C2.9-1.5l4.7-12.6c3.3-0.9%2C6.6-1.7%2C9.5-3.2L80.1%2C94%0A%09c0.9%2C0.7%2C2.5%2C0.5%2C3.2-0.4L97%2C78.3c0.7-0.9%2C1-2.4%2C0.1-3.1L87.3%2C64.8z%20M47.8%2C69.5C38.3%2C67.5%2C32%2C57.8%2C34%2C48.3%0A%09c2-9.5%2C11.7-15.8%2C21.2-13.8c9.5%2C2%2C15.7%2C11.7%2C13.7%2C21.2C66.9%2C65.2%2C57.3%2C71.5%2C47.8%2C69.5L47.8%2C69.5z%22%2F%3E%0A%3C%2Fsvg%3E');
  width:100px;
  height:100px;
  background-size:100% 100%;
  background-repeat:no-repeat;
}



.three {
  background: url('data:image/svg+xml,%3Csvg%20version%3D%221.1%22%0A%09%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20xmlns%3Aa%3D%22http%3A%2F%2Fns.adobe.com%2FAdobeSVGViewerExtensions%2F3.0%2F%22%0A%09%20x%3D%220px%22%20y%3D%220px%22%20width%3D%2281px%22%20height%3D%2280.5px%22%20viewBox%3D%220%200%2081%2080.5%22%20style%3D%22overflow%3Ascroll%3Benable-background%3Anew%200%200%2081%2080.5%3B%22%0A%09%20xml%3Aspace%3D%22preserve%22%3E%0A%3Cstyle%20type%3D%22text%2Fcss%22%3E%0A%09.st0%7Bfill%3A%23383838%3B%7D%0A%3C%2Fstyle%3E%0A%3Cdefs%3E%0A%3C%2Fdefs%3E%0A%3Cpath%20class%3D%22st0%22%20d%3D%22M30.3%2C68.2c1.2%2C0.2%2C2.3%2C0.9%2C3.8%2C1.2c1.6%2C0.3%2C2.7%2C0.6%2C4%2C0.4l4.9%2C9.6c0.6%2C0.9%2C1.4%2C1.1%2C2.3%2C0.9l15.3-4.9%0A%09c0.5-0.3%2C1-1%2C0.9-2.3l-1.8-10.6c2-1.6%2C3.6-3.7%2C5.3-5.8l10.5%2C0.6c1.1%2C0.6%2C2.1-0.4%2C2.3-1.1L81%2C40.7c0.2-0.8-0.4-2.1-1.1-2.3l-10.2-3.8%0A%09c-0.3-2.5-1.4-4.8-2.5-7.5l5.9-8.5c0.6-1.1%2C0.4-1.9-0.2-2.9l-12-10.7c-0.3-0.5-1.6-0.3-2.5%2C0.3l-8%2C6.9c-1.2-0.2-2.3-0.9-3.8-1.2%0A%09c-1.6-0.3-2.7-0.6-4-0.4L37.7%2C1c-0.6-0.9-1.4-1.1-2.3-0.9L20.1%2C5c-0.5%2C0.3-1%2C1-0.9%2C2.3l1.8%2C10.6c-2%2C1.6-3.6%2C3.7-5.3%2C5.8L5.3%2C23%0A%09c-0.8-0.2-1.7%2C0.4-2%2C1.6L0%2C40.2c-0.2%2C0.8%2C0.4%2C2.1%2C1.1%2C2.3l9.8%2C3.7c0.7%2C2.6%2C1.4%2C5.2%2C2.5%2C7.5l-6%2C8.9c-0.6%2C0.7-0.4%2C2%2C0.3%2C2.5l12%2C10.7%0A%09c0.7%2C0.5%2C1.9%2C0.8%2C2.4%2C0.1L30.3%2C68.2z%20M26.7%2C37.3c1.6-7.4%2C9.1-12.3%2C16.5-10.8S55.6%2C35.7%2C54%2C43.1c-1.6%2C7.4-9.1%2C12.3-16.5%2C10.7%0A%09C30.1%2C52.3%2C25.1%2C44.7%2C26.7%2C37.3L26.7%2C37.3z%22%2F%3E%0A%3C%2Fsvg%3E');
  width:80px;
  height:80px;
  background-size:100% 100%;
  background-repeat:no-repeat;
  margin-top:-50px;
  margin-left:-10px;
}

@keyframes spin-one {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(-359deg) ;
    transform: rotate(-359deg) ;
  }
}

.spin-one {
  -webkit-animation: spin-one 1.5s infinite linear;
  animation: spin-one 1.5s infinite linear;
}

@keyframes spin-two {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(-359deg);
    transform: rotate(359deg);
  }
}

.spin-two {
  -webkit-animation: spin-two 2s infinite linear;
  animation: spin-two 2s infinite linear;
}
</style>




<div id="galaxy" class="container" style="color: #fff;">




  <div id='stars'></div>
  <div id='stars2'></div>
  <div id='stars3'></div>
 



   <div class="box">
    <div class="animation">
     <div class="one spin-one"></div>
     <div class="two spin-two"></div>
     <div class="three spin-one"></div>
    </div>
  <h1 style="font-size: 3em;">Under maintenance</h1>
  <p  style="font-size: 1.8em;">Update in progress.  Please run installer to finish update.</p>
  <p  style="font-size: 1.8em;">Maintenance screen for<a href="<?php echo base_url()?>" target="_blank"><?=$this->getapi_model->nameweb()?></a></p>
  </div>


  <label for="hug" class="hug-button" style="background-color: #000;">
    <a href="<?php echo base_url()?>">เข้าสู่เว็บไซต์</a>
  </label>
</div>