<?php
namespace ApacheSolrForTypo3\Solr\Tests\Integration\System\Records\SystemLanguage;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2017 dkd Internet Service GmbH <solr-eb-support@dkd.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use ApacheSolrForTypo3\Solr\System\Records\SystemLanguage\SystemLanguageRepository;
use ApacheSolrForTypo3\Solr\Tests\Integration\IntegrationTest;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * SystemLanguageRepository to encapsulate the database access for records used in solr.
 *
 */
class SystemLanguageRepositoryTest extends IntegrationTest
{
    /**
     * @test
     */
    public function canFindOneLanguageTitleByLanguageId()
    {
        $this->importDataSetFromFixture('sys_language.xml');

        /* @var $repository SystemLanguageRepository */
        $repository = GeneralUtility::makeInstance(SystemLanguageRepository::class);
        $languageTitle = $repository->findOneLanguageTitleByLanguageId(1);
        $this->assertEquals('English', $languageTitle);
    }

    /**
     * @test
     */
    public function findOneLanguageTitleByLanguageIdReturnsDefaultIfLanguageIdIs0AndNoLanguagesAreDefined()
    {
        /* @var $repository SystemLanguageRepository */
        $repository = GeneralUtility::makeInstance(SystemLanguageRepository::class);
        $languageTitle = $repository->findOneLanguageTitleByLanguageId(0);
        $this->assertEquals('default', $languageTitle);
    }

    /**
     * @test
     */
    public function canFindSystemLanguages()
    {
        $this->importDataSetFromFixture('sys_language.xml');

        /* @var $repository SystemLanguageRepository */
        $repository = GeneralUtility::makeInstance(SystemLanguageRepository::class);
        $systemLanguages = $repository->findSystemLanguages();

        $expectedLangueages = [0, 1, 2, 3];
        $this->assertSame($expectedLangueages, $systemLanguages);
    }
}
