import pandas as pd
import csv

class Content_Curator:
    @staticmethod
    def get_all_ted_talks(DATASET_PATH = "../Data/Talks_Dataset.csv"):
        """
        Get a list of all TED Talks from the dataset.
        """
        ted_talks = {}

        with open(DATASET_PATH, newline='', encoding='utf-8') as csvfile:
            reader = csv.DictReader(csvfile)

            for row in reader:
                title = row['title']
                ted_talks[title] = {
                    'main_speaker': row['main_speaker'],
                    'description': row['description'],
                    'tags': row['tags'],
                    'url': row['url'],
                    'views': int(row['views'])  # Convertimos views a entero
                }

        return ted_talks
    
    @staticmethod
    def get_ted_talk_by_title(title):
        """
        Get a TED Talk by its title.
        """
        try:
            ted_talks_information = Content_Curator.get_all_ted_talks()
            ted_talk = ted_talks_information[title]
            #print(f"TED Talk found: {title}")
            return {'title': title, **ted_talk}
        except Exception as e:
            #print(f"Error al obtener la TED Talk: {e}")
            return None
        
    @staticmethod
    def get_all_interactions(INTERACTIONS_DATASET = "../Data/Interactions.csv"):
        """
        Get a list of all interactions from the dataset.
        """
        df = pd.read_csv(INTERACTIONS_DATASET, sep=",")
        df = df[df['percentage_watched'] > 10]
        
        return df


# Get First 200 titles of dataset of TED Talks
if __name__ == "__main__":
    curator = Content_Curator()
    ted_talks = curator.get_all_ted_talks()
    print(f"Total TED Talks: {len(ted_talks)}")
    
    # Print first 200 titles
    for title in list(ted_talks.keys())[:200]:
        print(title)
    
    # Example of getting a specific TED Talk by title
    talk_info = curator.get_ted_talk_by_title("The power of vulnerability")
    print(talk_info)
    
    # Get all interactions
    interactions = curator.get_all_interactions()
    print(interactions.head())       
        