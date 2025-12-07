<?php

namespace App\Support;

final class Constants
{
    /** ===== Auth / Roles ===== */
    public const ROLE_USER  = 'user';
    public const ROLE_ADMIN = 'admin';
    public const ROLES = [self::ROLE_USER, self::ROLE_ADMIN];

    /** ===== Genders ===== */
    public const GENDER_MALE   = 'male';
    public const GENDER_FEMALE = 'female';
    public const GENDER_OTHER  = 'other';
    public const GENDERS = [self::GENDER_MALE, self::GENDER_FEMALE, self::GENDER_OTHER];

    /** ===== User Status ===== */
    public const USER_STATUS_ACTIVE   = 'active';
    public const USER_STATUS_INACTIVE = 'inactive';
    public const USER_STATUSES = [self::USER_STATUS_ACTIVE, self::USER_STATUS_INACTIVE];

    /** ===== Goals ===== */
    public const GOAL_BULKING  = 'bulking';
    public const GOAL_SLIMMING = 'slimming';
    public const GOAL_HEALTHY  = 'healthy';
    public const GOAL_KIDS     = 'kids';
    public const GOALS = [self::GOAL_BULKING, self::GOAL_SLIMMING, self::GOAL_HEALTHY, self::GOAL_KIDS];

    /** ===== Workout Difficulty ===== */
    public const DIFFICULTY_EASY   = 'easy';
    public const DIFFICULTY_MEDIUM = 'medium';
    public const DIFFICULTY_HARD   = 'hard';
    public const DIFFICULTIES = [self::DIFFICULTY_EASY, self::DIFFICULTY_MEDIUM, self::DIFFICULTY_HARD];

    /** ===== Diet Types ===== */
    public const DIET_KETO         = 'keto';
    public const DIET_BALANCED     = 'balanced';
    public const DIET_HIGH_PROTEIN = 'high-protein';
    public const DIET_KIDS         = 'kids';
    public const DIET_TYPES = [self::DIET_KETO, self::DIET_BALANCED, self::DIET_HIGH_PROTEIN, self::DIET_KIDS];

    /** ===== Assignment Status (User↔Plans) ===== */
    public const ASSIGNMENT_ONGOING   = 'ongoing';
    public const ASSIGNMENT_COMPLETED = 'completed';
    public const ASSIGNMENT_PAUSED    = 'paused';
    public const ASSIGNMENT_STATUSES = [
        self::ASSIGNMENT_ONGOING, self::ASSIGNMENT_COMPLETED, self::ASSIGNMENT_PAUSED
    ];

    /** ===== Feedback Target (polymorphic) ===== */
    public const TARGET_WORKOUT   = 'workout';
    public const TARGET_NUTRITION = 'nutrition';
    public const TARGET_TYPES = [self::TARGET_WORKOUT, self::TARGET_NUTRITION];

    /** ===== Ratings ===== */
    public const RATING_MIN = 1;
    public const RATING_MAX = 5;
}
