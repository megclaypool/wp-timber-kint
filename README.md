# wp-timber-kint

This one-stop WordPress plugin includes [Kint](https://github.com/kint-php/kint), so that you can use `d()`, `kint()`, etc in your php files. It also defines a Timber function so that you can use `{{ kint() }}` or `{{ kint(somevariable) }}` in your twig files.

Timber is not required to use this plugin, but it's super awesome cool and if you haven't yet, you should really check it out :)

---

Credits:

Please note that this plugin was inspired by the [timber-kint-debug](https://github.com/kaido24/timber-kint-debug) plugin written by [Kaido Toomingas](http://web3.ee) (I totally copied the timber function he wrote!). However, I didn't want to have to install multiple plugins in order to use Kint in both PHP and Twig. A little research lead me to this article, [Use Kint for debugging in PHP/WordPress](https://letswp.io/kint-debugging-php-wordpress/) by [Firsh](https://letswp.io/author/firsh/) which made me realize how easy it would be to include Kint in my plugin.

Thanks!
