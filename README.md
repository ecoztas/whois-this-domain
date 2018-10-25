# whois-this-domain

Herhangi bir Domain'i (Alan Adı) sorgulama işlemi için geliştirilmiş bir PHP betiğidir. 
Alan adı sorgulama konusunu daha önce blogumda anlatmıştım. Bu yazıma ulaşmak için [buradaki](http://emrecanoztas.com/php-ile-domain-sorgulama/) bağlantıyı kullanabilirsiniz.

whois-this-domain, Socket veya cURL ile sorgulamak için 2 farklı dosya barındırır. Bunlar;
+ method.whois-curl.php
+ method.whois-socket.php

Bir üçüncü dosya;
+ config.variables.php
alan adı uzantıları ve bu uzantıları sağlayan servislerin adreslerini sağlar.
