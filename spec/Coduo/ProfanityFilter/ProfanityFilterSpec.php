<?php

namespace spec\Coduo\ProfanityFilter;

use Coduo\ProfanityFilter\Sanitizer\Sanitizer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProfanityFilterSpec extends ObjectBehavior
{
    public function let(Sanitizer $sanitizer)
    {
        $this->beConstructedWith($sanitizer, array());
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Coduo\ProfanityFilter\ProfanityFilter');
    }

    public function it_filters_bad_words_with_stars(Sanitizer $sanitizer)
    {
        $sanitizer->sanitizeWord(Argument::type('string'))->willReturn('[censored]');
        $this->beConstructedWith($sanitizer, array("fuck", "shit"));
        $this->sanitize("fuck this shit")->shouldReturn('[censored] this [censored]');
        $this->sanitize("fuck this crap")->shouldReturn('[censored] this crap');
    }
}