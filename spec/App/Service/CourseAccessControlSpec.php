<?php

namespace spec\App\Service;

use App\Service\CourseAccessControl;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CourseAccessControlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CourseAccessControl::class);
    }

}
