# whois-this-domain

Herhangi bir Domain'i (Alan Adı) sorgulama işlemi için geliştirilmiş bir PHP betiğidir. 
Alan adı sorgulama konusunu daha önce blogumda anlatmıştım. Bu yazıma ulaşmak için [buradaki](http://emrecanoztas.com/php-ile-domain-sorgulama/) bağlantıyı kullanabilirsiniz.

whois-this-domain, Socket veya cURL ile sorgulama yapmak için 2 farklı dosya barındırır. Bunlar;
+ method.whois-curl.php
+ method.whois-socket.php

Bir üçüncü dosya;
+ config.variables.php

alan adı uzantıları ve bu uzantıları sağlayan servislerin adreslerini, betik içerisinde kullanılan diğer sabit değişkenleri saklar.

Socket ve cURL ile işlem yapmak için 2 farklı metot bulunur ve her iki betik için de metot isimleri aynıdır.

Alan adı ve uzantısı ile birlikte sorgulama yapmak için;

```
whois($domain, $address);
```

metodu kullanılır. Burada;
+ $domain: Alan adı ve uzantısını temsil eder. Örneğin; emrecanoztas.com gibi.
+ $address: Alan adı uzantı servisini temsil eder. Örneğin; .com için whois.crsnic.net gibi.

Dolayısıyla kodlarımız aşağıdaki gibi olmalıdır.

```
whois('emrecanoztas', 'whois.crsnic.net');
```

Bir diğer metot ise; alan adı ve birden fazla uzantı için sorgulama işlemini gerçekleştirir.

```
search($domain, array($address...));
```
