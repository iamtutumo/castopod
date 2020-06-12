<?php
/**
 * Class AddEpisodes
 * Creates episodes table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEpisodes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
                'comment' => 'The episode ID',
            ],
            'podcast_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'comment' => 'The podcast ID',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'An episode title. title is a string containing a clear, concise name for your episode. Don’t specify the episode number or season number in this tag.',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'comment' => 'Episode slug for URLs',
            ],
            'enclosure_url' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The URL attribute points to your podcast media file. The file extension specified within the URL attribute determines whether or not content appears in the podcast directory. Supported file formats include M4A, MP3, MOV, MP4, M4V, and PDF.',
            ],
            'enclosure_length' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'comment' =>
                    'The length attribute is the file size in bytes. You can find this information in the properties of your podcast file (on a Mac, choose File > Get Info and refer to the size field).',
            ],
            'enclosure_type' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The type attribute provides the correct category for the type of file you are using. The type values for the supported file formats are: audio/x-m4a, audio/mpeg, video/quicktime, video/mp4, video/x-m4v, and application/pdf.',
            ],
            'guid' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The episode’s globally unique identifier (GUID). It is very important that each episode have a unique GUID and that it never changes, even if an episode’s metadata, like title or enclosure URL, do change. Globally unique identifiers (GUID) are case-sensitive strings. If a GUID is not provided an episode’s enclosure URL will be used instead. If a GUID is not provided, make sure that an episode’s enclosure URL is unique and never changes. Failing to comply with these guidelines may result in duplicate episodes being shown to listeners, inaccurate data in Podcast Analytics, and can cause issues with your podcasts’s listing and chart placement in Apple Podcasts.',
            ],
            'pub_date' => [
                'type' => 'DATETIME',
                'comment' =>
                    'The date and time when an episode was released. Format the date using the RFC 2822 specifications. For example: Wed, 15 Jun 2019 19:00:00 GMT.',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' =>
                    'An episode description. Description is text containing one or more sentences describing your episode to potential listeners. You can specify up to 4000 characters. You can use rich text formatting and some HTML (<p>, <ol>, <ul>, <li>, <a>) if wrapped in the <CDATA> tag. To include links in your description or rich HTML, adhere to the following technical guidelines: enclose all portions of your XML that contain embedded HTML in a CDATA section to prevent formatting issues, and to ensure proper link functionality.',
            ],
            'duration' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'comment' =>
                    'The duration of an episode. Different duration formats are accepted however it is recommended to convert the length of the episode into seconds.',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'comment' =>
                    'The artwork for the show. Specify your show artwork by providing a URL linking to it. Depending on their device, subscribers see your podcast artwork in varying sizes. Therefore, make sure your design is effective at both its original size and at thumbnail size. You should include a show title, brand, or source name as part of your podcast artwork. Artwork must be a minimum size of 1400 x 1400 pixels and a maximum size of 3000 x 3000 pixels, in JPEG or PNG format, 72 dpi, with appropriate file extensions (.jpg, .png), and in the RGB colorspace.',
            ],
            'explicit' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' =>
                    'The episode parental advisory information. Where the explicit value can be one of the following: true. If you specify true, indicating the presence of explicit content, Apple Podcasts displays an Explicit parental advisory graphic for your episode.     Episodes containing explicit material aren’t available in some Apple Podcasts territories.     false. If you specify false, indicating that the episode does not contain explicit language or adult content, Apple Podcasts displays a Clean parental advisory graphic for your episode.',
            ],
            'number' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'comment' =>
                    'An episode number. If all your episodes have numbers and you would like them to be ordered based on them use this tag for each one. Episode numbers are optional for <itunes:type> episodic shows, but are mandatory for serial shows. Where episode is a non-zero integer (1, 2, 3, etc.) representing your episode number.',
            ],
            'season_number' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'null' => true,
                'comment' =>
                    'The episode season number. If an episode is within a season use this tag. Where season is a non-zero integer (1, 2, 3, etc.) representing your season number. To allow the season feature for shows containing a single season, if only one season exists in the RSS feed, Apple Podcasts doesn’t display a season number. When you add a second season to the RSS feed, Apple Podcasts displays the season numbers.',
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['full', 'trailer', 'bonus'],
                'default' => 'full',
                'comment' =>
                    'The episode type. If an episode is a trailer or bonus content, use this tag. Where the episodeType value can be one of the following: full (default). Specify full when you are submitting the complete content of your show.     trailer. Specify trailer when you are submitting a short, promotional piece of content that represents a preview of your current show.     bonus. Specify bonus when you are submitting extra content for your show (for example, behind the scenes information or interviews with the cast) or cross-promotional content for another show.',
            ],
            'block' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' =>
                    'The episode show or hide status. If you want an episode removed from the Apple directory, use this tag. Specifying the <itunes:block> tag with a Yes value prevents that episode from appearing in Apple Podcasts. For example, you might want to block a specific episode if you know that its content would otherwise cause the entire podcast to be removed from Apple Podcasts. Specifying any value other than Yes has no effect.',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['podcast_id', 'slug']);

        // FIXME: as season_number can be null, the unique key constraint is useless when it is
        // the majority of RDBMS behave that way
        // possible solution: remove the null constraint on the season_number and set a default
        $this->forge->addUniqueKey(['podcast_id', 'season_number', 'number']);
        $this->forge->addForeignKey('podcast_id', 'podcasts', 'id');
        $this->forge->createTable('episodes');
    }

    public function down()
    {
        $this->forge->dropTable('episodes');
    }
}
