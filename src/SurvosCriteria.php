<?php

namespace Survos\Client;

class SurvosCriteria
{
    /** Comparison type. */
    const EQUAL = "equal";

    /** Comparison type. */
    const NOT_EQUAL = "not_equal";

    /** Comparison type. */
    const ALT_NOT_EQUAL = "alt_not_equal";

    /** Comparison type. */
    const GREATER_THAN = "greater_than";

    /** Comparison type. */
    const LESS_THAN = "less_than";

    /** Comparison type. */
    const GREATER_EQUAL = "greater_equal";

    /** Comparison type. */
    const LESS_EQUAL = "less_equal";

    /** Comparison type. */
    const LIKE = "like";

    /** Comparison type. */
    const NOT_LIKE = "not_like";

    /** Comparison type. */
    const IN = "in";

    /** "Order by" qualifier - ascending */
    const ASC = "asc";

    /** "Order by" qualifier - descending */
    const DESC = "desc";
}
