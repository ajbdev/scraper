=Scraper=

Quickly and easily scrape data from external sources with simple query strings.

Example:

```php
use Scraper\Scraper;
use Scraper\Source\Source;

$scraper = new Scraper();

$source = Source::create('https://news.ycombinator.com');
$source->setFakeIdentity(true);

$result = $scraper->scrape($source, 'td.title a');

foreach ($result as $node) {
    echo $node->nodeValue . PHP_EOL;
}

// IBM to cut 111,800 people from its workforce
// Chess: Who will win in this riveting game of Math.random() vs. Math.random()?
// First U.S. Bitcoin Exchange Set to Open
// ...
```
