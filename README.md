# BW Todo List Plugin

## Installation

To install the BW Todo List plugin, follow these steps:

### Prerequisites:

- Ensure you have Composer installed on your system. If not, you can download it from [Get Composer](https://getcomposer.org/download/).

### Download the Plugin:

- Download the ZIP file of the plugin from the repository or clone it using `git clone`.

### Upload to WordPress:

- Log in to your WordPress admin panel.
- Navigate to `Plugins` > `Add New`.
- Click the `Upload Plugin` button at the top of the page.
- Select the ZIP file of the plugin (if you downloaded it) and click `Install Now`.

### Activate the Plugin:

- Once the plugin is uploaded, click `Activate Plugin`.

## Using the BW Todo List

After activating the plugin, you can start using it to manage your tasks.

### Navigating the Admin Area

#### Accessing the Todo List:

- In the WordPress admin panel, navigate to `Todo List`. This is where you can view and manage all your tasks.

#### Adding a New Task:

- Click the `Add New` button.
- Enter the task title and description.
- Select a priority level (High, Medium, Low).
- Click `Save Task`.

#### Editing a Task:

- Next to each task, you'll find an `Edit` option.
- Click `Edit`, make your changes, and then click `Update Task` to save.

#### Deleting a Task:

- To delete a task, click the `Delete` option next to the task you want to remove.

### Importing Tasks:

- Go to the `Import/Export` tab.
- Under the `Import` section, upload a CSV file with your tasks.
- Click `Import`.

### Exporting Tasks:

- In the `Import/Export` tab, under the `Export` section, click `Export`.
- This will download a CSV file of your current tasks.

## Front-End Display

### Using the Shortcode:

- Use the shortcode `[bw-todo-list]` in any page or post to display the current user's To-Do List.
- You can also specify a color for the list by adding a `color` attribute, e.g., `[bw-todo-list color="blue"]`.


### Gutenberg Block:

- The plugin includes a custom Gutenberg block for easy insertion into posts and pages.
- Simply add the `BW Todo List` block to your post or page, and it will display the current user's tasks.
