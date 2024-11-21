<?php

namespace Database\Seeders;

use App\Models\LojaOnline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LojaOnlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*LojaOnline::create([
            'nome' => 'TeraByteShop',
            'UrlLoja' => 'https://www.terabyteshop.com.br/produto/23858/processador-amd-ryzen-9-7950x3d-42ghz-57ghz-turbo-16-cores-32-threads-am5-sem-cooler-100-100000908wof?p=139255&utm_source=craftmybox&utm_medium=afiliados&utm_campaign=craftmybox',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/164417/water-cooler-gigabyte-aorus-liquid-cooler-240-rgb-240mm-2x-120mm-amd-intel-com-display-lcd-preto-gp-aorus-waterforce-x-240?awc=17729_1718382965_162ac8b4a6f7ebadc80f8b8d3bd0bc6c&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-galax-geforce-rtx-4060-ti-1-click-oc-8gb-gddr6-128-bit-46isl8md8coc?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/376219/placa-mae-asus-rog-strix-x670e-a-gaming-wi-fi-amd-x670-am5-ddr5-90mb1bm0-m0eay0?awc=17729_1718383370_ec4411877bcaecd7b3dfa8064d521437&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/448307/memoria-ram-kingston-fury-beast-rgb-32gb-6000mhz-ddr5-cl36-branco-kf560c36bwea-32?awc=17729_1718383481_e57cf22b7a90c52900c6b007430990af&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/ssd-kingston-nv2-1tb-m-2-2280-pcie-nvme-leitura-3500mb-s-gravacao-2100mb-s-snv2s-1000g?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/386140/gabinete-gamer-rise-mode-galaxy-glass-sound-mid-tower-rgb-led-lateral-e-frontal-em-vidro-temperado-sem-fans-preto-rm-ga-ggs-fb?awc=17729_1718383717_ad69bc127b0d56df53bd5a0d6814c42a&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/471344/fonte-xpg-kyber-750w-80-plus-gold-com-cabo-preto-kyber750g-bkcbr?awc=17729_1718383940_49b79295a0eab20f91d10541c66f1058&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'TeraByteShop',
            'UrlLoja' => 'https://www.terabyteshop.com.br/produto/20072/processador-intel-core-i5-12400f-25ghz-44ghz-turbo-12-geracao-6-cores-12-threads-lga-1700-bx8071512400f?p=139255&utm_source=craftmybox&utm_medium=afiliados&utm_campaign=craftmybox',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/cooler-deepcool-gammaxx-series-ag400-wh-argb-120mm-branco-r-ag400-whanmc-g-2?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-galax-geforce-gtx-1650-ex-plus-4gb-gddr6-1-click-oc-128-bit-65sql8ds93e1?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'TeraByteShop',
            'UrlLoja' => 'https://www.terabyteshop.com.br/produto/23827/placa-mae-asrock-h610m-hvs-chipset-h610-intel-lga-1700-matx-ddr4?p=139255&utm_source=craftmybox&utm_medium=afiliados&utm_campaign=craftmybox',
        ]);

        LojaOnline::create([
            'nome' => 'TeraByteShop',
            'UrlLoja' => 'https://www.terabyteshop.com.br/produto/19314/memoria-kingston-fury-beast-8gb-3200mhz-ddr4-black-kf432c16bb8?p=139255&utm_source=craftmybox&utm_medium=afiliados&utm_campaign=craftmybox',
        ]);

        LojaOnline::create([
            'nome' => 'TeraByteShop',
            'UrlLoja' => 'https://www.terabyteshop.com.br/produto/23002/ssd-kingston-nv2-500gb-m2-nvme-2280-leitura-3500mbs-e-gravacao-2100mbs-snv2s500g?p=139255&utm_source=craftmybox&utm_medium=afiliados&utm_campaign=craftmybox',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/gabinete-gamer-pichau-apus-white-mid-tower-lateral-de-vidro-temperado-com-3-fans-branco-pg-aps-wht01?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/368437/fonte-gamemax-gs600-600w-80-plus-white-pfc-ativo-com-cabo-preto-gs600?awc=17729_1718385754_e23f7140c2c8eababd52219ed4b679b8&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/375646/processador-intel-core-i5-3470-3-geracao-3-20ghz-cache-6mb-quad-core-4-threads-lga-1155-oem-326b770?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF4ziaKWmy3MkUm951VC8_XadwNY1IZ1b_CDkLfGt2734o2MaDyMAmxoCdQQQAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/cooler-para-processador-pcyes-lorx-rainbow-92mm-aclx92rb-115169?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF5Sh6cWnOSYwqeWOacFuzpwuIx6EM_VDqZWkxUCUu-lzgQuXxqrGLxoCsxkQAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-gigabyte-geforce-gt-1030-2gb-ddr4-low-profile-d4-64-bit-gv-n1030d4-2gl?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-mae-tgt-h61-m-2-ddr3-socket-lga1155-m-atx-chipset-intel-h61-tgt-h61-m2?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF1JhT_U3Wz1jkWHyIehIdPbQdKoa0dqJqoGeXYQ0X6We4AAcWAUevxoCQJIQAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/117541/memoria-oxy-8gb-1333mhz-ddr3-cl9-oxy1333d3n9-8g?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF-opNwgBt5D4EmtTw8AYtrKdrfFvLzp-Ynmx6yH5xgpw8-eWdxpv-xoCsi8QAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/ssd-wd-green-240gb-2-5-sata-iii-6gb-s-leitura-545-mb-s-gravacao-430-mb-s-wds240g3g0a?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/gabinete-gamer-tgt-jester-mid-tower-lateral-de-vidro-com-2-fans-preto-tgt-jsr-bkgf01?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF1Bnd6l5JlKqG6vFLSIG_H-IcK-naPq0eQM7HFgDEYKUhqM3khOjUxoCJfsQAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/434535/fonte-brazil-pc-bpc-230-atx-230w-real-24-pinos?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF8P0JMKbAHAxPOmgfTxff-xKixfufZDuKMItJHnlJummaPxe0WiUFRoC220QAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'TeraByteShop',
            'UrlLoja' => 'https://www.terabyteshop.com.br/produto/20072/processador-intel-core-i5-12400f-25ghz-44ghz-turbo-12-geracao-6-cores-12-threads-lga-1700-bx8071512400f?p=139255&utm_source=craftmybox&utm_medium=afiliados&utm_campaign=craftmybox',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/419099/water-cooler-rise-mode-aura-frost-pro-argb-240mm-amd-intel-branco-rm-wcz-06-argb?awc=17729_1718388319_7e4daf41728681a8865b8188848e2bc6&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/514536/placa-de-video-rx-6600-v2-asus-dual-amd-radeon-8gb-gddr6-90yv0gp2-m0na00?awc=17729_1718388448_f252887fc65fba83ccd37119fae6ab0a&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-mae-biostar-h610mh-ddr4-socket-lga1700-m-atx-chipset-intel-h610-h610mh?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF3_HJF_u_1o3RjWoWahz6GtZUcq6lD7JVHsJnpuiox-R7nzAGXWgnBoCLnsQAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/108317/memoria-ram-rise-mode-diamond-8gb-3200mhz-ddr4-cl15-branco-rm-d4-8g-3200d?awc=17729_1718388613_952f755ad7fce2721d0ae0f0bf2eef4e&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/404331/ssd-sata-500gb-crucial-bx500-ct500bx500ssd1?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF9_zYzU23T9PDoub-dl8RqM7qljPXpATxzSEr0SDBM0QJOFMKaLTXxoCRCUQAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'TeraByteShop',
            'UrlLoja' => 'https://www.terabyteshop.com.br/produto/25220/gabinete-gamer-montech-air-903-max-mid-tower-e-atx-black-sem-fonte-com-4-fans?p=139255&utm_source=craftmybox&utm_medium=afiliados&utm_campaign=craftmybox',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/fonte-corsair-cv-series-cv550-80-plus-bronze-550w-cp-9020210-br?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/112991/processador-intel-core-i5-10400f-2-9ghz-4-3ghz-max-turbo-cache-12mb-6-nucleos-12-threads-lga-1200-bx8070110400f?awc=17729_1718389230_e0149f2c1523754dd2763aefba6ad3f2&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/248205/water-cooler-rise-mode-argb-240mm-amd-intel-preto-rm-wcb-04-argb?awc=17729_1718389313_d8592ed3cd6ce54b3389beea094ccc2d&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/459144/placa-de-video-rx-7600-challenger-asrock-amd-radeon-8gb-gddr6-90-ga41zz-00uanf?awc=17729_1718389447_807e447717cbc3be6a752d51e7b80562&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-mae-msi-pro-h510m-b-ddr4-socket-lga1200-m-atx-chipset-intel-h510-911-7e05-004?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF4v-X-rpWDljMJJSe0eHsW_WVarxM-XvzdHruELbUWEVFnPqgIYP5RoCur8QAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/480530/memoria-ram-kingston-fury-beast-rgb-32gb-2x16gb-3200mhz-ddr4-cl16-preto-kf432c16bb12ak2-32?awc=17729_1718389654_5d06bf3f90e71fdb6881969202e1dbad&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/ssd-sandisk-1tb-sata-iii-6gb-s-leitura-535-mb-s-gravacao-350-mb-s-sdssda-1t00-g27?gad_source=1&gclid=CjwKCAjw1K-zBhBIEiwAWeCOF30r5LBRl6Y-kZTF6qUZVZgxSDdIpJ_3qgRUTHFJHJWmG9d7i1Uh3xoCXPoQAvD_BwE',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/gabinete-gamer-aigo-darkflash-dlm-21-branco-lateral-vidro?utm_source=meupcnet&utm_medium=afiliados&utm_campaign=meupcnet',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/114164/fonte-gigabyte-gp-p550b-550w-80-plus-bronze-pfc-ativo-com-cabo-preto-28200-p550b-1brr?awc=17729_1718389935_0b06765da2a71ec89e478a17b112e963&utm_source=AWIN&utm_medium=AFILIADOS&utm_campaign=fevereiro24&utm_content=2024-06-14&utm_term=691737',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/520369/processador-amd-ryzen-7-5700x3d-3-6-ghz-4-1ghz-max-turbo-cache-4mb-8-nucleos-16-threads-am4-100-100001503wof',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/333145/processador-amd-ryzen-5-4600g-3-7ghz-4-2ghz-max-turbo-cache-11mb-am4-video-integrado-100-100000147box',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/102248/processador-amd-ryzen-3-3200g-3-6ghz-4ghz-max-turbo-cache-4mb-quad-core-4-threads-am4-yd3200c5fhbox',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/283718/processador-intel-core-i5-12400f-2-5ghz-4-4ghz-max-turbo-cache-18mb-lga-1700-bx8071512400f',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/283713/processador-intel-core-i5-12400-2-5ghz-4-4ghz-max-turbo-cache-18mb-lga-1700-bx8071512400',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/148917/processador-intel-core-i5-11400f-2-6-ghz-4-4ghz-turbo-cache-12mb-6-nucleos-12-threads-lga1200-bx8070811400f',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/497579/processador-intel-core-i5-14600kf-14-geracao-5-3-ghz-max-turbo-cache-24mb-14-nucleos-20-threads-lga1700-bx8071514600kf',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/112991/processador-intel-core-i5-10400f-2-9ghz-4-3ghz-max-turbo-cache-12mb-6-nucleos-12-threads-lga-1200-bx8070110400f',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/405766/processador-intel-core-i5-13400f-4-6ghz-max-turbo-cache-20mb-10-nucleos-16-threads-lga-1700-bx8071513400f',
        ]);

        LojaOnline::create([
            'nome' => 'Kabum',
            'UrlLoja' => 'https://www.kabum.com.br/produto/357990/processador-amd-ryzen-5-4600g-box-1900mhz-cache-3mb-hexa-core-12-threads-100-100000147',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/processador-intel-core-i3-14100-4-core-8-threads-3-5ghz-4-7ghz-turbo-cache-12mb-lga1700-bx8071514100',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/processador-amd-athlon-3000g-2-core-4-threads-3-5ghz-cache-5mb-am4-yd3000c6fhsbx',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/processador-amd-ryzen-9-7950x3d-16-core-32-threads-4-2ghz-5-7ghzturbo-cache-144mb-am5-100-100000908wof',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/processador-amd-a10-9700e-4-core-3-0ghz-3-5ghz-turbo-cache-2mb-am4-ad9700ahabbox',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/processador-amd-athlon-300ge-2-core-4-threads-3-4ghz-cache-5mb-am4-yd30gec6m2ofh',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/162665/memoria-ram-gamer-husky-gaming-avalanche-16gb-3200mhz-ddr4-cl19-preto-hgmf008',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/114222/memoria-ram-husky-gaming-8gb-2666mhz-ddr4-cl19-preto-hgmf001',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/454454/memoria-ram-husky-gaming-storm-rgb-16gb-3200mhz-ddr4-cl22-preto-hgmf021',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/454443/memoria-ram-husky-gaming-storm-rgb-8gb-3200mhz-ddr4-cl22-preto-hgmf018',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/454459/memoria-ram-husky-gaming-blizzard-rgb-16gb-3600mhz-ddr4-cl26-prata-hgmf026',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/memoria-corsair-vengeance-lpx-16gb-2x8-ddr4-2400mhz-c14-preta-cmk16gx4m2a2400c14',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/memoria-corsair-vengeance-lpx-8gb-2x4-ddr4-2400mhz-c16-preta-cmk8gx4m2a2400c16',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/memoria-corsair-value-select-8gb-1x8-ddr4-2133mhz-c15-preta-cmv8gx4m1a2133c15',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/memoria-corsair-value-select-8gb-1x8-ddr4-2133mhz-c15-preta-cmv8gx4m1a2133c15',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/memoria-para-notebook-team-group-t-create-classic-16gb-1x16gb-ddr4-3200mhz-ttcbd416g3200hc22-s01',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/153647/kit-com-3-ventoinhas-rise-mode-energy-120mm-argb-preto-fn-02-rgb-5v',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/130043/water-cooler-rise-mode-gamer-black-rgb-240mm-amd-intel-preto-rm-wcb-02-rgb',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/130040/air-cooler-rise-mode-gamer-g800-rgb-amd-intel-90mm-preto-rm-ac-o8-rgb',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/419100/water-cooler-rise-mode-aura-frost-pro-argb-360mm-amd-intel-branco-rm-wcf-07-argb',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/water-cooler-aigo-darkflash-ap240-argb-240mm-branco-ap240white',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/cooler-para-processador-thermalright-assassin-spirit-as120-evo-argb-120mm-branco-tl-as120-wh',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/458886/placa-mae-msi-b450m-a-pro-max-amd-am4-micro-atx-ddr4',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/199618/placa-mae-gigabyte-a520m-s2h-amd-am4-m-atx-ddr4',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/133767/placa-mae-asrock-b450m-steel-legend-amd-am4-matx-ddr4',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/505312/placa-mae-knup-a320-amd-ryzen-hdmi-ddr4-32gb-6-gb-s-usb-3-0',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-mae-asus-tuf-gaming-a520m-plus-ii-ddr4-socket-amd-am4-m-atx-chipset-amd-a520-tuf-gaming-a520m-plus-ii',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-mae-biostar-b550mt-ddr4-socket-am4-m-atx-chipset-amd-b550-b550mt',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-mae-tgt-h61-t-ddr3-lga-1155-m-atx-chipset-intel-h61-tgt-h61-t',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-mae-biostar-a520m-ddr4-socket-amd-am4-m-atx-chipset-amd-a520-a520mt',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/469132/placa-de-video-rtx-4060-ventus-2x-black-oc-msi-nvidia-geforce-8gb-gddr6-dlss-ray-tracing',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/115753/placa-de-video-galax-nvidia-geforce-gtx-1650-ex-plus-1-click-oc-4gb-gddr6-65sql8ds93e1',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/525880/placa-de-video-rx-550-amd-pcyes-dual-fan-projeto-edge-4gb-gddr5-128-bits-pvex5504gbdf',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-afox-radeon-rx-550-4gb-gddr5-128-bit-afrx550-4096d5h4-v6',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-galax-geforce-rtx-3050-ex-6gb-gddr6-96-bit-35nrldmd9oex-nac',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-gigabyte-geforce-rtx-3050-windforce-oc-6gb-gddr6-96-bit-gv-n3050wf2oc-6gd',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-pcyes-geforce-gtx-1660-ti-6gb-gddr6-192-bit-branco-pvgtx1660ti6gbbr',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-msi-geforce-rtx-4060-ti-gaming-x-8gb-gddr6-128-bit-912-v515-069',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/placa-de-video-inno3d-geforce-rtx-4070-super-twin-x2-oc-12gb-gddr6x-192-bit-n407s2-126xx-186162n',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/538895/placa-de-video-gtx-1650-d6-ventus-xs-ocv3-msi-nvidia-geforce-4gb-gddr6-g-sync-912-v812-003',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/301518/placa-de-video-quadro-t1000-pny-nvidia-8gb-gddr6-pcie-3-0-vcnt10008gb-pb',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/380745/ssd-1-tb-kingston-nv2-m-2-2280-pcie-nvme-leitura-3500-mb-s-e-gravacao-2100-mb-s-snv2s-1000g',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/95217/ssd-sata-kingston-a400-960gb-2-5-leitura-500mb-s-e-gravacao-450mb-s-preto-sa400s37-960g',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/310157/ssd-250-gb-wd-blue-sn570-m-2-2280-nvme-leitura-3300mb-s-e-gravacao-1200mb-s-azul-wds250g3b0c',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/100014/ssd-sata-adata-su650-120gb-2-5-leitura-520mb-s-e-gravacao-450mb-s-preto-asu650ss-120gt-r',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/ssd-nas-apacer-endurance-pp3480-256gb-m-2-2280-pcie-nvme-leitura-2450mb-s-gravacao-2000mb-s-ap256gpp3480-r',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/ssd-apacer-as350x-2tb-2-5-sata-iii-6gb-s-leitura-560mb-s-gravacao-540mb-s-ap2tbas350xr-1',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/ssd-portatil-apacer-as722-1tb-usb-3-2-preto-ap1tbas722b-1',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/609955/processador-amd-ryzen-7-5800xt-3-8-ghz-4-8-ghz-max-turbo-cache-32-mb-8-nucleos-16-threads-am4-com-cooler-100-100001582box',
        ]);

        LojaOnline::create([
            'nome' => 'Pichau',
            'UrlLoja' => 'https://www.pichau.com.br/ssd-apacer-as350x-256gb-2-5-sata-iii-6gb-s-leitura-560mb-s-gravacao-540mb-s-ap256gas350xr-1',
        ]);

        LojaOnline::create([
            'nome' => 'KABUM',
            'UrlLoja' => 'https://www.kabum.com.br/produto/369658/fonte-msi-mag-a650bn-650w-80-plus-bronze-pfc-ativo-com-cabo-preto-306-7zp2b22-ce0',
        ]);
*/

    }
}
